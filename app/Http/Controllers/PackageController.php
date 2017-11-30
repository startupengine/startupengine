<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use App\Role;

class PackageController extends Controller
{

    public function index(Request $request)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            if ($request->input('s') !== null) {
                $packages = \App\Package::where('url', 'ILIKE', '%' . $request->input('s') . '%')->limit(100)->orderBy('updated_at', 'desc')->get();
            } else {
                $packages = \App\Package::limit(100)->orderBy('updated_at', 'desc')->get();
            }
            return view('app.packages.index')->with('packages', $packages);
        } else {
            abort(404);
        }
    }

    public function savePackage(Request $request){
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $package = new Package();
            $package->url = $request->input('url');
            $package->save();
            return redirect('/app/packages');
        } else {
            abort(404);
        }

    }

    public function deletePackage(Request $request, $id){
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $package = Package::where('id', '=', $id)->first();
            $package->delete();
            return redirect('/app/packages');
        } else {
            abort(404);
        }

    }
}
