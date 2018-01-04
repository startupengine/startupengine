<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\PostType;

class SchemaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('s') !== null) {
            $postTypes = PostType::where('slug', 'LIKE', '%' . $request->input('s') . '%')->limit(100)->orderBy('created_at', 'asc')->get();
        } else {
            $postTypes = PostType::all();
        }
        return view('app.schema.index')->with('postTypes', $postTypes)->with('request', $request);
    }

    public function editSchema(Request $request, $slug)
    {
        $postType = PostType::where('slug', '=', $slug)->first();
        return view('app.schema.edit')->with('postType', $postType)->with('request', $request);
    }

    public function saveSchema(Request $request, $slug)
    {
        $postType = PostType::where('slug', '=', $slug)->first();
        if ($postType !== null) {
            $postType->title = $request->input('title');
            $postType->slug = $request->input('slug');
            if (json_decode($request->input('json'))) {
                $postType->json = json_encode(json_decode($request->input('json')));
            }
            $postType->save();
            return redirect('/app/schema');
        }
    }
}
