<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;

class SettingController extends Controller
{
    public function addSetting(Request $request) {
        $setting = new Setting();
        return view('app.setting.edit')->with('setting', $setting);
    }

    public function editSetting(Request $request, $id) {
        $setting = \App\Setting::find($id);
        return view('app.setting.edit')->with('setting', $setting);
    }

    public function saveSetting(Request $request) {

        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {

            if($request->input('id') !== null ){
                $setting = \App\Setting::find($request->input('id'));
            }
            else {
                $setting = new Setting();
            }

            if($request->input('display_name') !== null ) {
                $setting->display_name = $request->input('display_name');
            }

            if($request->input('key') !== null ) {
                $setting->key = $request->input('key');
            }

            if($request->input('value') !== null ) {
                $setting->value = $request->input('value');
            }

            if($request->input('status') == null) {
                $setting->status = 'PRIVATE';
            }
            else {
                $setting->status = $request->input('status');
            }

            if($request->input('publish') == "on") {
                $setting->status = "PUBLISHED";
            }

            if($request->input('type') == null) {
                $setting->type = 'text';
            }
            else {
                $setting->type = $request->input('type');
            }

            $setting->save();
            return redirect('/app/settings');
        }

        else { abort(500); }
    }
}