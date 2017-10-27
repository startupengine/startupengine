<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;

class SettingController extends Controller
{
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

            $setting->display_name= $request->input('display_name');
            $setting->value = $request->input('value');
            if($request->input == null) {
                $setting->status = 'PRIVATE';
            }
            else {
                $setting->status = $request->input('status');
            }

            if($request->input('publish') == "on") {
                $setting->status = "PUBLISHED";
            }
            $setting->save();
            return redirect('/app/settings');
        }

        else { abort(500); }
    }
}
