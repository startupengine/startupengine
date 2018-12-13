<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.content.index');
    }

    public function view(Request $request, $id)
    {
        $item = \App\Post::find($id);
        $options = [
            'id' => $item->id,
            'type' => 'content',
            'index_uri' => '/admin/content'
        ];

        return view('admin.components.resource_view')->with('item', $item)->with('options', $options);
    }

}