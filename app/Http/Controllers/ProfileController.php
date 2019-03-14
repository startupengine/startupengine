<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = \Auth::user();
        if ($user && $user->hasPermissionTo('view backend') && $user->hasPermissionTo('view own profile')) {
            $user = \Auth::user();
            return view('app.profile.view')->with('user', $user)->with('disabled', 'disabled');
        } else {
            abort(404);
        }
    }

    public function editProfile(Request $request)
    {
        $user = \Auth::user();
        if ($user &&  $user->hasPermissionTo('view backend') && $user->hasPermissionTo('edit own profile')) {
            return view('app.profile.edit')->with('user', $user)->with('disabled', null);
        } else {
            abort(404);
        }
    }

    public function saveProfile(Request $request)
    {
        $user = \Auth::user();
        if ($user && $user->hasPermissionTo('edit own profile')) {
            $user = \Auth::user();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if ($request->input('password') !== null && $request->input('confirm_password') !== null && $request->input('password') == $request->input('confirm_password')) {
                $user->password = bcrypt($request->input('password'));
            }
            $user->save();
            return redirect('/app/profile');
        }
    }
}
