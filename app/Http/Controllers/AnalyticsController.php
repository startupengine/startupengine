<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('view') !== null) {
            $view = $request->input;
        } else {
            $view = 'mixpanel';
        }
        return view('app.analytics.index')->with('view', $view);
    }

    public function mixpanel(Request $request)
    {
        return view('app.analytics.mixpanel');
    }

}
