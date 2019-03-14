<?php

namespace App\Http\Controllers;

use App\AnalyticEvent;
use Illuminate\Http\Request;
use App\Role;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $stats = [];
        $stats['pageViews'] = count(
            \App\AnalyticEvent::where('event_type', '=', 'page viewed')
                ->whereDate(
                    'created_at',
                    '>',
                    \Carbon\Carbon::now()->subDays(30)
                )
                ->get()
        );
        $stats['contentViews'] = count(
            \App\AnalyticEvent::where('event_type', '=', 'content viewed')
                ->whereDate(
                    'created_at',
                    '>',
                    \Carbon\Carbon::now()->subDays(30)
                )
                ->get()
        );
        $stats['clicks'] = count(
            \App\AnalyticEvent::where('event_type', '=', 'click')
                ->whereDate(
                    'created_at',
                    '>',
                    \Carbon\Carbon::now()->subDays(30)
                )
                ->get()
        );
        $stats['users'] = count(
            \App\User::whereDate(
                'created_at',
                '>',
                \Carbon\Carbon::now()->subDays(30)
            )->get()
        );
        //$stats['subscriptions'] = count(\App\Subscription::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(30))->get());
        $stats['transactions'] = count(
            \App\AnalyticEvent::where('event_type', '=', 'product purchased')
                ->whereDate(
                    'created_at',
                    '>',
                    \Carbon\Carbon::now()->subDays(30)
                )
                ->get()
        );

        $oldStats = [];
        $oldStats['pageViews'] = count(
            \App\AnalyticEvent::where('event_type', '=', 'page viewed')
                ->whereBetween('created_at', [
                    \Carbon\Carbon::now()
                        ->subDays(60)
                        ->toDateTimeString(),
                    \Carbon\Carbon::now()
                        ->subDays(30)
                        ->toDateTimeString()
                ])
                ->get()
        );
        $oldStats['contentViews'] = count(
            \App\AnalyticEvent::where('event_type', '=', 'content viewed')
                ->whereBetween('created_at', [
                    \Carbon\Carbon::now()
                        ->subDays(60)
                        ->toDateTimeString(),
                    \Carbon\Carbon::now()
                        ->subDays(30)
                        ->toDateTimeString()
                ])
                ->get()
        );
        $oldStats['clicks'] = count(
            \App\AnalyticEvent::where('event_type', '=', 'click')
                ->whereBetween('created_at', [
                    \Carbon\Carbon::now()
                        ->subDays(60)
                        ->toDateTimeString(),
                    \Carbon\Carbon::now()
                        ->subDays(30)
                        ->toDateTimeString()
                ])
                ->get()
        );
        $oldStats['users'] = count(
            \App\User::whereBetween('created_at', [
                \Carbon\Carbon::now()
                    ->subDays(60)
                    ->toDateTimeString(),
                \Carbon\Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            ])->get()
        );
        //$oldStats['subscriptions'] = count(\App\Subscription::whereBetween('created_at',  [ \Carbon\Carbon::now()->subDays(60)->toDateTimeString(), \Carbon\Carbon::now()->subDays(30)->toDateTimeString()] )->get());
        $oldStats['transactions'] = count(
            \App\AnalyticEvent::where('event_type', '=', 'product purchased')
                ->whereBetween('created_at', [
                    \Carbon\Carbon::now()
                        ->subDays(60)
                        ->toDateTimeString(),
                    \Carbon\Carbon::now()
                        ->subDays(30)
                        ->toDateTimeString()
                ])
                ->get()
        );

        //dd([$oldStats, $stats]);
        return view('admin.analytics.index')
            ->with('stats', $stats)
            ->with('oldStats', $oldStats);
    }
}
