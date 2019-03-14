<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.users.index');
    }

    public function view(Request $request, $id)
    {
        $item = \App\User::find($id);
        $options = [
            'id' => $item->id,
            'type' => 'user',
            'index_uri' => '/admin/users',
            'buttons' => [
                "top_nav" => [
                    "Preferences" =>[
                        "class" => "btn-dark",
                        "text" => "<i class='material-icons'>list_alt</i> View Preferences",
                        "link" => "/admin/users/$item->id/preferences"
                    ]
                ]
            ]
        ];

        return view('admin.components.resource_view')->with('item', $item)->with('options', $options);
    }

    public function newUser()
    {
        return view('app.user.add');
    }

    public function viewUser($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();
        return view('app.profile.view')->with('user', $user)->with('disabled', 'disabled');
    }

    public function editUser($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();
        return view('app.profile.edit')->with('user', $user)->with('disabled', null);
    }

    public function deleteUser($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();
        $user->delete();
        return redirect('/app/users');
    }


    public function saveUser(Request $request)
    {

        if ($request->input('user_id') !== null) {
            $user = User::where('id', '=', $request->input('user_id'))->firstOrFail();
        } else {
            $user = new User();
        }
        if ($request->input('email') !== null) {
            $user->email = $request->input('email');
        }
        if ($request->input('name') !== null) {
            $user->name = $request->input('name');
        }
        if ($request->input('role_id') !== null) {
            $user->role_id = $request->input('role_id');
        }
        if ($request->input('status') !== null) {
            $user->status = $request->input('status');
        }
        if ($request->input('password') !== null && $request->input('confirm_password') !== null && $request->input('password') == $request->input('confirm_password')) {
            $user->password = bcrypt($request->input('password'));
        }
        if ($user->password == null) {
            $user->password = Hash::make(str_random(8));
        }
        if ($user->role_id == null) {
            $userrole = Role::where('name', '=', 'user')->first();
            if ($userrole == null) {
                $user->role_id = 0;
            } else {
                $user->role_id = $userrole->id;
            }
        }
        $user->save();
        return redirect('/app/users');

    }
}
