<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingGroupController extends Controller
{
    public function index(Request $request, $group)
    {
        $groupFilter = $group;
        $groupSlug = strtolower($group);
        //dd($groupSlug);
        $group = \App\Setting::where('key', '=', $groupSlug.'.settings_description')->first();
        return view('admin.settings.groups.index')->with('group', $group)->with('groupFilter', $groupFilter);
    }
}
