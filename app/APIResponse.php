<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Analytics;
use Spatie\Analytics\Period;

class APIResponse extends Model
{
    public function getOverview(){
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function getTraffic() {
        $period = Period::days(30);
        $traffic = Analytics::fetchTotalVisitorsAndPageViews($period);
        return response()->json([
            'status' => 'success',
            'period' => $period,
            'raw' => $traffic
        ]);
    }

    public function getEvents() {
        $period = Period::days(30);
        $events = Analytics::performQuery($period,'ga:totalEvents,ga:sessions',  ['sort'=>'ga:date', 'dimensions' => 'ga:date']);
        return response()->json([
            'status' => 'success',
            'period' => $period,
            'totals' => $events->totalsForAllResults,
            'raw' => $events
        ]);
    }
}