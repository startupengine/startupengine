<?php

namespace App\Http\Controllers;

use App\Setting;
use App\PostType;
use Illuminate\Http\Request;
use App\Role;

class SettingController extends Controller
{

    public function index(Request $request)
    {

        if ($request->input('s') !== null) {
            $settings = \App\Setting::where('key', 'LIKE', '%' . $request->input('s') . '%')->orWhere('display_name', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('value', 'ILIKE', '%' . $request->input('s') . '%')->limit(100)->orderBy('display_name', 'asc')->get();
        } elseif ($request->input('group') !== null) {
            $settings = \App\Setting::where('group', '=', $request->input('group'))->limit(100)->orderBy('display_name', 'asc')->get();
        } else {
            $settings = new \App\Setting();
            $settings = $settings->appSettings();
        }
        $postTypes = PostType::all();
        $settingsGroups = Setting::all()->groupBy('group');
        return view('app.setting.index')->with('settings', $settings)->with('postTypes', $postTypes)->with('request', $request)->with('settingsGroups', $settingsGroups);

    }

    public function addSetting(Request $request)
    {
        $setting = new Setting();
        return view('app.setting.add')->with('setting', $setting);
    }

    public function editSetting(Request $request, $id)
    {
        $setting = \App\Setting::find($id);
        return view('app.setting.edit')->with('setting', $setting);
    }

    public function saveSetting(Request $request)
    {
        if ($request->input('id') !== null) {
            $setting = \App\Setting::find($request->input('id'));
        } else {
            $setting = new Setting();
        }

        if ($request->input('display_name') !== null) {
            $setting->display_name = $request->input('display_name');
        }

        if ($request->input('key') !== null) {
            $setting->key = $request->input('key');
        }

        $setting->value = $request->input('value');

        if ($request->input('status') == null) {
            $setting->status = 'PRIVATE';
        } else {
            $setting->status = $request->input('status');
        }

        if ($request->input('publish') == "on") {
            $setting->status = "PUBLISHED";
        }

        if ($request->input('type') == null) {
            $setting->type = 'text';
        } else {
            $setting->type = $request->input('type');
        }

        $setting->save();
        return redirect("/app/edit/setting/$setting->id");
    }
}