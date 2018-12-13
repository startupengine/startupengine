<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(){
        return view('admin.logs.index');
    }

    public function view(Request $request, $id)
    {
        $item = \App\Log::find($id);
        $options = [
            'id' => $item->id,
            'type' => 'log',
            'index_uri' => '/admin/logs',
            'custom_view' => 'admin.logs.view'
        ];

        return view('admin.components.resource_view')->with('item', $item)->with('options', $options);
    }
}
