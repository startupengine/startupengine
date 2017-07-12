<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Contentful\Delivery\Client as DeliveryClient;
use Analytics;
use Spatie\Analytics\Period;
use Charts;


class AdminController extends Controller
{

    /**
     * @var DeliveryClient
     */
    private $client;

    public function __construct(DeliveryClient $client) {
        $this->client = $client;
    }

    public function index() {
        return view('admin.index');
    }

    public function pages() {
        $popular = Analytics::fetchMostVisitedPages(Period::days(30), 10);
        $referrers = Analytics::fetchTopReferrers(Period::days(30), 10);
        return view('admin.pages')->with('popular', $popular)->with('referrers', $referrers);
    }

    public function analytics(Request $request) {
        if($request->period == "week") {
            $days = 7;
        }
        elseif($request->period == "month") {
            $days = 30;
        }
        elseif($request->period == "year") {
            $days = 365;
        }
        else {
            $days = 30;
        }
        if($request->start == NULL) {
            $period = Period::days($days);
        }
        else {
            $start = \Carbon\Carbon::createFromFormat('m/d/Y', $request->start);
            $end = \Carbon\Carbon::createFromFormat('m/d/Y', $request->start)->addDays($days);
            $period = Period::create($start, $end);
            if(!$start->isPast()) {
                return redirect ('/admin/analytics');
            }
        }

        $sessions = Analytics::performQuery($period, 'ga:sessions')->totalsForAllResults["ga:sessions"]; //Total number of sessions
        $bounceRate = Analytics::performQuery($period, 'ga:bounceRate')->totalsForAllResults["ga:bounceRate"]; //Number of sessions ended from the entrance page
        $totalSessionTime = Analytics::performQuery($period, 'ga:sessionDuration')->totalsForAllResults["ga:sessionDuration"]; //Sum of all session durations (in seconds)
        $avgSessionDuration = Analytics::performQuery($period, 'ga:avgSessionDuration')->totalsForAllResults["ga:avgSessionDuration"]; //Average session duration (in seconds)
        $traffic = Analytics::fetchTotalVisitorsAndPageViews($period);
        $countries = Analytics::performQuery($period,'ga:sessions',  ['dimensions'=>'ga:country','sort'=>'-ga:sessions']);
        $countries = collect($countries['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'country' =>  $dateRow[0],
                'sessions' => (int) $dateRow[1],
            ];
        });
        $countrylist = [];
        $countrysessions = [];
        foreach ($countries as $country) {
            $countrylist[] = $country['country'];
            $countrysessions[] = $country['sessions'];
        }
        foreach($traffic as $item) {
            $visitors[] = $item['visitors'];
            $views[] = $item['pageViews'];
            $date = $item['date']->toFormattedDateString();
            $dates[] = $date;
        }
        $next = $period->startDate->copy();
        $next = $next->addDays($days);
        $prev = $period->startDate->copy();
        $prev = $prev->subDays($days);

        $traffic = Charts::multi('bar', 'chartjs')
            // Setup the chart settings
            ->title("Traffic for the last $days days")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 400) // Width x Height
            ->colors(['#f44256','#ffc107','#4444dd'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Unique Visitors', $visitors)
            ->dataset('Page Views', $views)
            // Setup what the values mean
            ->labels($dates);
        $countries = Charts::multi('bar', 'chartjs')
            // Setup the chart settings
            ->title("Traffic by country for the last $days days")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 400) // Width x Height
            ->colors(['#f44256','#ffc107','#4444dd'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Sessions', $countrysessions)
            // Setup what the values mean
            ->labels($countrylist);
        return view('admin.analytics')->with('traffic', $traffic)->with('countries', $countries)->with('sessions', $sessions)->with('bounceRate', $bounceRate)->with('totalSessionTime', $totalSessionTime)->with('avgSessionDuration', $avgSessionDuration)->with('period', $days)->with('prev', $prev)->with('next', $next);
    }
}
