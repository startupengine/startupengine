<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function newUser()
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            return view('app.user.add');
        }
        else {
            abort(404);
        }
    }

    public function viewUser($id)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $user = User::where('id', '=', $id)->firstOrFail();
            return view('app.profile.edit')->with('user', $user)->with('disabled', 'disabled');
        }
        else {
            abort(404);
        }
    }

    public function editUser($id)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $user = User::where('id', '=', $id)->firstOrFail();
            return view('app.profile.edit')->with('user', $user)->with('disabled', null);
        }
        else {
            abort(404);
        }
    }

    public function deleteUser($id)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $user = User::where('id', '=', $id)->firstOrFail();
            $user->delete();
            return redirect('/app/users');
        }
        else {
            abort(404);
        }
    }


    public function saveUser(Request $request)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            if($request->input('user_id') !== null) {
                $user = User::where('id', '=', $request->input('user_id'))->firstOrFail();
            }
            else {
                $user = new User();
            }
            if($request->input('email') !== null) {
                $user->email = $request->input('email');
            }
            if($request->input('name') !== null) {
                $user->name = $request->input('name');
            }
            if($request->input('role_id') !== null) {
                $user->role_id = $request->input('role_id');
            }
            if($request->input('status') !== null) {
                $user->status = $request->input('status');
            }
            if($request->input('password') !== null && $request->input('confirm_password') !== null && $request->input('password') == $request->input('confirm_password')) {
                $user->password = bcrypt($request->input('password'));
            }
            if($user->password == null){
                $user->password = Hash::make(str_random(8));
            }
            if($user->role_id == null) {
                $userrole = Role::where('name', '=','user')->first();
                if($userrole == null){
                    $user->role_id = 0;
                }
                else {
                    $user->role_id = $userrole->id;
                }
            }
            $user->save();
            return redirect('/app/users');
        }
        else {
            abort(404);
        }
    }
}
