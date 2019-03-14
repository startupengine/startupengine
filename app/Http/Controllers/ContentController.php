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
            'index_uri' => '/admin/content',
            'buttons' => [
                'top_nav' => [
                    'View' => [
                        'link' => '/content/' . $item->id,
                        'class' => 'btn btn-dark',
                        'text' =>
                            '<i class="material-icons mr-2">search</i>View',
                        'target' => '_blank'
                    ]
                ]
            ]
        ];

        return view('admin.components.resource_view')
            ->with('item', $item)
            ->with('options', $options);
    }
}
