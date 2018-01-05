<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Role;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('s') !== null) {
            $permissions = \App\Permission::where('title', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('slug', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('post_type', 'ILIKE', '%' . $request->input('s') . '%')->limit(100)->orderBy('updated_at', 'desc')->get();
        } else {
            $permissions = \App\Permission::limit(100)->orderBy('updated_at', 'desc')->get();
        }
        return view('app.permission.index')->with('permissions', $permissions);
    }

    public function addPermission(Request $request){
        return view('app.permission.add');
    }

    public function savePermission(Request $request){
        $name = $request->input('name');
        $permission = Permission::where('name', '=', $name)->first();
        if($permission == null) {
            $permission = new Permission();
            $permission->guard_name = $request->input('guard_name');
            $permission->name = $request->input('name');
            $permission->save();
        }
        return redirect('/app/permissions');
    }
}
