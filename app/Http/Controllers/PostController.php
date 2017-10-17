<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;

class PostController extends Controller
{
    public function index() {
        $page =  Page::where('slug', '=', 'help')->first();
        if ($page == null) {
            abort(404);
        }
        return view('pages.view')->with('page', $page)->with('template', 'help');
    }

    public function getPost($slug) {
        $post =  Post::where('slug', '=', $slug)->first();
        if ($post == null) {
            abort(404);
        }
        return view('posts.view')->with('post', $post);
    }

    public function getCategory($slug) {
        $category = Category::where('slug', '=', $slug)->first();
        if ($category == null) {
            abort(404);
        }
        $posts =  Post::where('category_id', '=', $category->id)->get();
        if ($posts == null) {
            abort(404);
        }
        return view('help.category')->with('articles', $posts)->with('category', $category);
    }
}