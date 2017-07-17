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
        $period = Period::days(30);
        $traffic = Analytics::fetchTotalVisitorsAndPageViews($period);
        foreach($traffic as $item) {
            $visitors[] = $item['visitors'];
            $views[] = $item['pageViews'];
            $date = $item['date']->toFormattedDateString();
            $dates[] = $date;
        }
        $title = $period->startDate->format('F dS').' to '.$period->endDate->format('F dS');
        $traffic = Charts::multi('bar', 'chartjs')
            // Setup the chart settings
            ->title(' ')
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 400) // Width x Height
            ->colors(['#f44256','#ffc107','#4444dd'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Unique Visitors', $visitors)
            ->dataset('Page Views', $views)
            // Setup what the values mean
            ->labels($dates);
        return view('admin.index')->with('traffic', $traffic)->with('trafficTitle', $title)->with('active', 'dashboard');
    }

    public function content(Request $request) {
        $days = $request->period;
        if($days == NULL) { $days = 30; }
        if($days == NULL OR !isset($days)) {
            $period = Period::days(30);
        }
        else {
            $period = Period::days($days);
        }
        $campaign = $request->input('campaign');
        $page = $request->input('page');
        $tag = $request->input('tag');
        if($page == 'articles' OR $page == 'landings' OR $page == 'products' OR $page == 'services') {
            if($page == 'articles') {
                $filters = 'ga:pagePath=@/article';
            }
            if($page == 'landings') {
                $filters = 'ga:pagePath=@/landing';
            }
            if($page == 'products') {
                $filters = 'ga:pagePath=@/product';
            }
            if($page == 'services') {
                $filters = 'ga:pagePath=@/service';
            }
            $popular = Analytics::performQuery($period,'ga:pageviews,ga:uniquePageviews,ga:timeOnPage,ga:bounces,ga:entrances,ga:exits', ['dimensions'=>'ga:pagePath,ga:pageTitle', 'filters' => $filters, 'sort' => '-ga:pageViews']);
        }
        else {
            $popular = Analytics::performQuery($period, 'ga:pageviews,ga:uniquePageviews,ga:timeOnPage,ga:bounces,ga:entrances,ga:exits', ['dimensions' => 'ga:pagePath,ga:pageTitle', 'sort' => '-ga:pageViews']);
        }
        if($tag == NULL && $page == NULL && $campaign == NULL) { $page = "all"; }
        return view('admin.content')->with('popular', $popular)->with('active', 'content')->with('campaign', $campaign)->with('page', $page)->with('tag', $tag)->with('period', $days);
    }

    public function campaign($slug = NULL) {
        /*$query = (new \Contentful\Delivery\Query());
        $query->setContentType('campaign');
        $campaigns = $this->client->getEntries($query);
        dd($campaigns);*/
        return view('admin.campaign'); //->with('campaigns', $campaigns);
    }

    public function analytics(Request $request) {
        $path = storage_path() . "/app/google/analytics-credentials.json";
        if (!file_exists($path)){
            $url = config('analytics.credentials');
            $contents = file_get_contents($url);
            \Storage::disk('local')->put('/google/analytics-credentials.json', $contents);
        }

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
        $referrers = Analytics::fetchTopReferrers($period, 10);
        $sessions = Analytics::performQuery($period, 'ga:sessions')->totalsForAllResults["ga:sessions"]; //Total number of sessions
        $events = Analytics::performQuery($period,'ga:totalEvents,ga:sessions',  ['sort'=>'ga:date', 'filters' => 'ga:eventCategory==article', 'dimensions' => 'ga:date']);
        foreach ($events->rows as $event) {
            //$date = $event[0];
            //$carbon = new Carbon;
            //$date = $carbon->toFormattedDateString($date);
            $item = $event[1];
            $articleEvents[] = $item;
        }
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
        $title = $period->startDate->toFormattedDateString().' to '.$period->endDate->toFormattedDateString();
        $traffic = Charts::multi('bar', 'chartjs')
            // Setup the chart settings
            ->title(' ')
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 400) // Width x Height
            ->colors(['#f44256','#ffc107','#4444dd'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Unique Visitors', $visitors)
            ->dataset('Page Views', $views)
            ->dataset('Interactions with Articles', $articleEvents)
            // Setup what the values mean
            ->labels($dates);
        $countries = Charts::multi('bar', 'chartjs')
            // Setup the chart settings
            ->title(" ")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 250) // Width x Height
            ->colors(['#4444dd','#ffc107','#4444dd'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Sessions', $countrysessions)
            // Setup what the values mean
            ->labels($countrylist);
        return view('admin.analytics')->with('traffic', $traffic)->with('countries', $countries)->with('sessions', $sessions)->with('bounceRate', $bounceRate)->with('totalSessionTime', $totalSessionTime)->with('avgSessionDuration', $avgSessionDuration)->with('period', $days)->with('prev', $prev)->with('next', $next)->with('referrers', $referrers)->with('trafficTitle', $title)->with('active', 'analytics')->with('events', $events);
    }

    public function apps() {
        return view('admin.apps')->with('active', 'apps');
    }

}