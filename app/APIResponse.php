<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Analytics;
use Spatie\Analytics\Period;

class APIResponse extends Model
{
    public function getPeriod($request) {
        $days = $request->days;
        if($days == NULL) {
            // Default to a period of 30 days
            $days = 30;
            $period = Period::days(30);
        }
        else {
            // Set period manually if it's specified in the request
            $period = Period::days($days);
        }
        if($request->start !== NULL) {
            // Set a start date manually if it's specified in the request
            $start = \Carbon\Carbon::createFromFormat('m/d/Y', $request->start);
            $end = \Carbon\Carbon::createFromFormat('m/d/Y', $request->start)->addDays($days);
            $period = Period::create($start, $end);
            if(!$start->isPast()) {
                return response()->json([
                    'status' => 'failure',
                    'error' => 'Start date is in the future.'
                ]);
            }
        }
        return $period;
    }

    public function getContent($client, $type = null, $campaign = null) {
        if($type == NULL) {
            $type = 'page';
        }
        $query = (new \Contentful\Delivery\Query());
        $query->setContentType($type);
        if($campaign !== null) {
            $query->setContentType($type)
                ->setInclude(2)
                ->where('fields.campaign.sys.contentType.sys.id', 'campaign')
                ->where('fields.campaign.fields.slug', $campaign);
        }
        $results = $client->getEntries($query);
        return response()->json([
            'status' => 'success',
            'raw' => $results
        ]);
    }

    public function getTraffic($request, $path = null) {
        $period = $this->getPeriod($request);
        $traffic = Analytics::fetchTotalVisitorsAndPageViews($period);
        if($path !== null) {
            $filters = "ga:pagePath=@/$path";
            $popular = Analytics::performQuery($period,'ga:pageviews,ga:uniquePageviews,ga:timeOnPage,ga:bounces,ga:entrances,ga:exits', ['dimensions'=>'ga:pagePath,ga:pageTitle', 'filters' => $filters, 'sort' => '-ga:pageViews']);
        }
        return response()->json([
            'status' => 'success',
            'period' => $period,
            'raw' => $traffic
        ]);
    }

    public function getEvents($request, $type = null) {
        $period = $this->getPeriod($request);
        if($type !== null OR $request->campaign !== null) {
            $filters = "";
            if(isset($type)) {
                $filters = $filters."ga:eventCategory==$type";
            }
            if(isset($request->campaign)) {
                if($filters !== "") { $filters = $filters.";";} // The semicolon represents the AND operator (combines filters)
                $filters =  $filters."ga:eventLabel==$request->campaign";
            }
            $events = Analytics::performQuery($period,'ga:totalEvents,ga:sessions',  ['sort'=>'ga:date', 'filters' => "$filters", 'dimensions' => 'ga:date']);
        } else {
            $events = Analytics::performQuery($period,'ga:totalEvents,ga:sessions',  ['sort'=>'ga:date', 'dimensions' => 'ga:date']);
        }
        return response()->json([
            'status' => 'success',
            'period' => $period,
            'totals' => $events->totalsForAllResults,
            'raw' => $events
        ]);
    }

    public function performQuery($request, $metrics = 'ga:totalEvents,ga:sessions', $options = ['sort'=>'ga:date', 'dimensions' => 'ga:date']) {
        $period = $this->getPeriod($request);
        if($request->metrics !== null) { $metrics = $request->metrics; }
        if($request->options !== null) { $options = $request->options; }
        $results = Analytics::performQuery($period, $metrics, $options);
        return response()->json([
            'status' => 'success',
            'period' => $period,
            'raw' => $results
        ]);
    }
}