<?php

namespace App\Http\Controllers;

use App\PostType;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Voyager;
use Jaam\Mixpanel\DataExportApi;
use Jaam\Mixpanel\DataExportApiException;

class AppController extends Controller
{

    public function index()
    {
        $user = \Auth::user();
        //dd($user->hasPermissionTo('view backend'));

        if($user->hasPermissionTo('browse pages')){
            return redirect('/app/pages');
        }

        if($user->hasPermissionTo('browse posts')){
            return redirect('/app/content');
        }

        if($user->hasPermissionTo('browse own posts')){
            return redirect('/app/content');
        }

        if($user->hasPermissionTo('browse settings')){
            return redirect('/app/settings');
        }

        if($user->hasPermissionTo('browse packages')){
            return redirect('/app/packages');
        }

        if($user->hasPermissionTo('view analytics')){
            return redirect('/app/analytics');
        }

    }

    public function login(Request $request)
    {
        if (\Auth::user()) {
            if (\Auth::user() && $request->input('redirect') !== null) {
                dd($request->input('redirect'));
                return redirect($request->input('redirect'));
            } else {
                return redirect('/');
            }
        } else {
            return view('app.login');
        }
    }

    public function api(Request $request)
    {
        return view('app.api.tokens');
    }

}