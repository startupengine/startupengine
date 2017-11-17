<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request) {

        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $user = \Auth::user();
            return view('app.profile.view')->with('user', $user);
        }
        else {
            abort(404);
        }
    }

    public function editProfile(Request $request) {

        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $user = \Auth::user();
            return view('app.profile.edit')->with('user', $user);
        }
        else {
            abort(404);
        }
    }

    public function saveProfile(Request $request) {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $user = \Auth::user();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if($request->input('password') !== null && $request->input('confirm_password') !== null && $request->input('password') == $request->input('confirm_password')) {
                $user->password = bcrypt($request->input('password'));
            }
            $user->save();
            return redirect('/app/profile');
        }
    }
}
