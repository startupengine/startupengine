<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
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
        $stats['transactions'] = count(
            \App\Payment::whereDate(
                'created_at',
                '>',
                \Carbon\Carbon::now()->subDays(30)
            )->get()
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
        $oldStats['transactions'] = count(
            \App\Payment::whereBetween('created_at', [
                \Carbon\Carbon::now()
                    ->subDays(60)
                    ->toDateTimeString(),
                \Carbon\Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            ])->get()
        );

        return view('admin.dashboard.index')
            ->with('stats', $stats)
            ->with('oldStats', $oldStats);
    }
}
