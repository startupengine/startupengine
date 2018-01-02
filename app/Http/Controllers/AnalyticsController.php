<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            if($request->input('view') !== null){
                $view = $request->input;
            }
            else {
                $view = 'mixpanel';
            }
            return view('app.analytics.index')->with('view', $view);
        } else {
            abort(404);
        }

    }
    public function mixpanel(Request $request)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            return view('app.analytics.mixpanel');
        } else {
            abort(404);
        }

    }

}
