<?php

namespace App\Http\Controllers;

use App\AnalyticEvent;
use Illuminate\Http\Request;
use App\Role;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('view') !== null) {
            $view = $request->input;
        } else {
            $view = 'default';
        }
        $analytics = AnalyticEvent::where('event_type', '!=', null)->orderBy('created_at')->get();

        $analytics = $analytics->groupBy('event_type');

        $analytics->transform(function ($item, $key) {
            $item = $item->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('m-d-Y'); });
            $item->transform(function ($date, $key) {
                $date->count = count($date);
                return $date;
            });
            return $item;
        });
        //dd($analytics);
        return view('app.analytics.index')->with('view', $view)->with('analytics', $analytics);
    }

    public function mixpanel(Request $request)
    {
        return view('app.analytics.mixpanel');
    }

}
