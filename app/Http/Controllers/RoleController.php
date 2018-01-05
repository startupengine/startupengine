<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\User;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('s') !== null) {
            $roles = \App\Role::where('name', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('display_name', 'ILIKE', '%'.$request->input('s').'%')->limit(100)->orderBy('updated_at', 'desc')->get();
        } else {
            $roles = Role::withCount('users')->get();
        }
        return view('app.role.index')->with('roles', $roles);
    }

    public function edit($id)
    {
        $permissions = Permission::all()->groupBy('guard_name');
        $role = Role::find($id);
        return view('app.role.edit')->with('role', $role)->with('permissions', $permissions);
    }
}
