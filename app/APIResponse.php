<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Analytics;
use Spatie\Analytics\Period;

class APIResponse extends Model
{
    public function getAnalytics(){
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);
    }

    public function getTraffic() {

        $period = Period::days(30);
        $traffic = Analytics::fetchTotalVisitorsAndPageViews($period);
        foreach($traffic as $item) {
            $visitors[] = $item['visitors'];
            $views[] = $item['pageViews'];
            $date = $item['date']->toFormattedDateString();
            $dates[] = $date;
        }
        return response()->json([
            'status' => 'success',
            'period' => $period,
            'dates' => $dates
        ]);
    }
}
