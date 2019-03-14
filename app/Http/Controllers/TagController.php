<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('s') !== null) {
            $tags = \App\Tag::where(
                'slug',
                'LIKE',
                '%' . $request->input('s') . '%'
            )
                ->orWhere('name', 'ILIKE', '%' . $request->input('s') . '%')
                ->limit(100)
                ->orderBy('count', 'desc')
                ->get();
        } else {
            $tags = \App\Tag::orderBy('count', 'desc')->get();
        }

        return view('app.tag.index')
            ->with('tags', $tags)
            ->with('request', $request);
    }
}
