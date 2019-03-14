<?php

namespace App\Http\Controllers;

use App\PreferenceSchema;
use Illuminate\Http\Request;

class PreferenceSchemaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.preferences.schemas.index');
    }

    public function view(Request $request, $id)
    {
        $item = \App\PreferenceSchema::find($id);
        $options = [
            'id' => $item->id,
            'type' => 'preferenceschema',
            'index_uri' => '/admin/preferences/schemas'
        ];

        return view('admin.components.resource_view')->with('item', $item)->with('options', $options);
    }
}
