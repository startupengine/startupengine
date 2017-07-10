<?php

namespace App\Http\Controllers;

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

    public function analytics() {
        $sessions = Analytics::performQuery(Period::days(30), 'ga:sessions')->totalsForAllResults["ga:sessions"]; //Total number of sessions
        $bounceRate = Analytics::performQuery(Period::days(30), 'ga:bounceRate')->totalsForAllResults["ga:bounceRate"]; //Number of sessions ended from the entrance page
        $totalSessionTime = Analytics::performQuery(Period::days(30), 'ga:sessionDuration')->totalsForAllResults["ga:sessionDuration"]; //Sum of all session durations (in seconds)
        $avgSessionDuration = Analytics::performQuery(Period::days(30), 'ga:avgSessionDuration')->totalsForAllResults["ga:avgSessionDuration"]; //Average session duration (in seconds)
        $popular = Analytics::fetchMostVisitedPages(Period::days(30), 10);
        $referrers = Analytics::fetchTopReferrers(Period::days(30), 10);
        $traffic = Analytics::fetchTotalVisitorsAndPageViews(Period::days(30));
        foreach($traffic as $item) {
            $visitors[] = $item['visitors'];
            $views[] = $item['pageViews'];
            $date = $item['date']->toFormattedDateString();
            $dates[] = $date;
        }
        $traffic = Charts::multi('bar', 'chartjs')
            // Setup the chart settings
            ->title("Traffic for the last 30 days")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 400) // Width x Height
            ->colors(['#f44256','#ffc107','#4444dd'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Unique Visitors', $visitors)
            ->dataset('Page Views', $views)
            // Setup what the values mean
            ->labels($dates);
        return view('admin.analytics')->with('popular', $popular)->with('referrers', $referrers)->with('traffic', $traffic)->with('sessions', $sessions)->with('bounceRate', $bounceRate)->with('totalSessionTime', $totalSessionTime)->with('avgSessionDuration', $avgSessionDuration);
    }
}
