<?php

namespace App\Http\Controllers;

use App\Preference;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{

    public function view(Request $request, $id)
    {
        /*dd(\Auth::user()->permissions);
        $roles = \Auth::user()->roles;
        $roles->transform(function ($item, $key) {
            return $item->name;
        });
        $roles = $roles->toArray();
        dd($roles);
        $preferences = \App\PreferenceSchema::whereJsonContains('json->permissions->read->roles', ['admin'])->orWhereJsonContains('json->permissions->read->roles', ['user'])->get();
        dd($preferences); */
        //dd(\Auth::user()->roles);
        $item = \App\Preference::find($id);
        $options = [
            'id' => $item->id,
            'type' => 'preference',
            'index_uri' => '/admin/preference'
        ];

        return view('admin.components.resource_view')->with('item', $item)->with('options', $options);
    }
}
