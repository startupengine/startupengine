<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            if ($request->input('s') !== null) {
                $roles = \App\Role::where('name', 'ILIKE', '%' . $request->input('s') . '%')->limit(100)->orderBy('updated_at', 'desc')->get();
            } else {
                $roles = \App\Role::limit(100)->get();
            }
            return view('app.role.index')->with('roles', $roles);
        } else {
            abort(404);
        }

    }

    public function edit($id)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        $role = \App\Role::where('id', '=', $id)->firstOrFail();
        $permissions = \App\Permission::all();
        //dd($permissions->groupBy('table_name'));
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id && $role !== null) {
            return view('app.role.edit')->with('role', $role)->with('permissions', $permissions);

        } else {
            abort(404);
        }

    }
}
