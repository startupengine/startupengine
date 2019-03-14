<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Artisan;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('s') !== null) {
            $permissions = \App\Permission::where('name', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('guard_name', 'ILIKE', '%' . $request->input('s') . '%')->limit(100)->orderBy('updated_at', 'desc')->get();
        } else {
            $permissions = \App\Permission::limit(100)->orderBy('updated_at', 'desc')->get();
        }
        return view('app.permission.index')->with('permissions', $permissions);
    }

    public function addPermission(Request $request)
    {
        return view('app.permission.add');
    }

    public function savePermission(Request $request)
    {
        $name = $request->input('name');
        $guard = $request->input('guard_name');
        $permission = Permission::where('name', '=', $name)->where('guard_name', '=', $guard)->first();
        if ($permission == null) {
            $permission = new Permission();
            $permission->guard_name = $request->input('guard_name');
            $permission->name = $request->input('name');
            $permission->save();
        }
        $exitcode = Artisan::call('cache:clear');
        return redirect('/app/permissions');
    }
}
