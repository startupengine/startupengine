<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.docs.index');
    }

    public function view(Request $request, $id)
    {
        $item = \App\Doc::find($id);
        $options = [
            'id' => $item->id,
            'type' => 'log',
            'index_uri' => '/admin/logs',
            'custom_view' => 'admin.docs.view'
        ];

        ///dd($options);

        return view('admin.components.resource_view')
            ->with('item', $item)
            ->with('options', $options);
    }
}
