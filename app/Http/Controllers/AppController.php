<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{

    public function index()
    {
        $stats = [];
        $stats['pageViews'] = count(\App\AnalyticEvent::where('event_type','=', 'page viewed')->whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(30))->get());
        $stats['contentViews'] = count(\App\AnalyticEvent::where('event_type','=', 'content viewed')->whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(30))->get());
        $stats['clicks'] = count(\App\AnalyticEvent::where('event_type','=', 'click')->whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(30))->get());
        $stats['users'] = count(\App\User::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(30))->get());
        //$stats['subscriptions'] = count(\App\Subscription::whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(30))->get());
        $stats['transactions'] = count(\App\AnalyticEvent::where('event_type','=', 'product purchased')->whereDate('created_at', '>', \Carbon\Carbon::now()->subDays(30))->get());


        $oldStats = [];
        $oldStats['pageViews'] = count(\App\AnalyticEvent::where('event_type','=', 'page viewed')->whereBetween('created_at',  [ \Carbon\Carbon::now()->subDays(60)->toDateTimeString(), \Carbon\Carbon::now()->subDays(30)->toDateTimeString()] )->get());
        $oldStats['contentViews'] = count(\App\AnalyticEvent::where('event_type','=', 'content viewed')->whereBetween('created_at',  [ \Carbon\Carbon::now()->subDays(60)->toDateTimeString(), \Carbon\Carbon::now()->subDays(30)->toDateTimeString()] )->get());
        $oldStats['clicks'] = count(\App\AnalyticEvent::where('event_type','=', 'click')->whereBetween('created_at',  [ \Carbon\Carbon::now()->subDays(60)->toDateTimeString(), \Carbon\Carbon::now()->subDays(30)->toDateTimeString()] )->get());
        $oldStats['users'] = count(\App\User::whereBetween('created_at',  [ \Carbon\Carbon::now()->subDays(60)->toDateTimeString(), \Carbon\Carbon::now()->subDays(30)->toDateTimeString()] )->get());
        //$oldStats['subscriptions'] = count(\App\Subscription::whereBetween('created_at',  [ \Carbon\Carbon::now()->subDays(60)->toDateTimeString(), \Carbon\Carbon::now()->subDays(30)->toDateTimeString()] )->get());
        $oldStats['transactions'] = count(\App\AnalyticEvent::where('event_type','=', 'product purchased')->whereBetween('created_at',  [ \Carbon\Carbon::now()->subDays(60)->toDateTimeString(), \Carbon\Carbon::now()->subDays(30)->toDateTimeString()] )->get());

        //dd([$oldStats, $stats]);
        return view('admin.dashboard.index')->with('stats', $stats)->with('oldStats', $oldStats);
    }

    public function login(Request $request)
    {
        if (\Auth::user()) {
            if (\Auth::user() && $request->input('redirect') !== null) {
                return redirect($request->input('redirect'));
            } else {
                if(setting('site.homepage') != null){
                    $route = setting('site.homepage');
                    $page = \App\Page::where('slug', $route)->first();
                    if($page != null){
                        $route = '/'.$page->slug;
                    }
                    else { $route = '/docs';}
                }
                elseif(\Auth::user()->hasPermissionTo('view backend')) { $route = '/admin'; }
                else { $route = '/'; }
                return redirect($route);
            }
        } else {
            return view('app.login');
        }
    }

}