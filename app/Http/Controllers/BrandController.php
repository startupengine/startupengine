<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $settings = \App\Setting::where('status', '!=', 'PRIVATE')->where('group', '=', 'Theme')->orderBy('updated_at', 'asc')->get();
        $logo = \App\Setting::where('key', '=', 'site.logo')->get();
        $name = \App\Setting::where('key', '=', 'site.name')->get();
        $settings = $logo->merge($settings);
        $settings = $name->merge($settings);
        return view('app.brand.index')->with('settings', $settings)->with('request', $request);
    }
}
