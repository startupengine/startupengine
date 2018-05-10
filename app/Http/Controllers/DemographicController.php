<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemographicController extends Controller
{
    public function index(Request $request) {
        $user = \Auth::user();
        if($user && $user->hasPermissionTo('view backend')) {
            return view('app.demographics.index');
        }
        else {
            abort(404);
        }
    }

    public function addDemographic(Request $request) {
        $user = \Auth::user();
        if($user && $user->hasPermissionTo('view backend')) {
            return view('app.demographics.add');
        }
        else {
            abort(404);
        }
    }


    public function editDemographic(Request $request, $id) {
        $user = \Auth::user();
        if($user && $user->hasPermissionTo('view backend')) {
            $demo = \App\Demographic::where('id', '=', $id)->firstOrFail();
            return view('app.demographics.edit')->with('demographic', $demo);
        }
        else {
            abort(404);
        }
    }

    public function saveDemographic(Request $request) {
        $user = \Auth::user();
        if($user && $user->hasPermissionTo('view backend')) {
            $name = $request->input('name');
            $description = $request->input('description');
            $json = json_encode(["subreddits" => $request->input('subreddits')]);

            if($request->input('id') !== null) {
                $demo = \App\Demographic::find($request->input('id'));
            }
            else {
                $demo = new \App\Demographic();
            }
            $demo->name = $name;
            $demo->description = $description;
            $demo->json = $json;
            $demo->save();
            return view('app.demographics.index');
        }
        else {
            abort(404);
        }
    }

    public function deleteDemographic(Request $request, $id) {
        if(\Auth::user()->hasPermissionTo('edit users')) {
            if($id !== null ){
                $demo = \App\Demographic::find($id);
                $demo->delete();
            }
            return redirect('/app/demographics');
        }
        else { abort(500); }
    }

}
