<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use App\Role;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('s') !== null) {
            $packages = \App\Package::where(
                'url',
                'ILIKE',
                '%' . $request->input('s') . '%'
            )
                ->orWhere(
                    'description',
                    'ILIKE',
                    '%' . $request->input('s') . '%'
                )
                ->limit(100)
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $packages = \App\Package::limit(100)
                ->orderBy('updated_at', 'desc')
                ->get();
        }
        return view('app.packages.index')->with('packages', $packages);
    }

    public function savePackage(Request $request)
    {
        $package = new Package();
        $package->url = $request->input('url');
        $package->save();
        return redirect('/app/packages');
    }

    public function deletePackage(Request $request, $id)
    {
        $package = Package::where('id', '=', $id)->first();
        $package->delete();
        return redirect('/app/packages');
    }
}
