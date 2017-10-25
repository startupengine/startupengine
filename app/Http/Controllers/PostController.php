<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Role;

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

    public function addPost() {
        $categories = \App\Category::all();
        return view('app.post.add')->with('categories', $categories);
    }

    public function savePost(Request $request) {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $post = new \App\Post;
            $post->title = $request->input('title');
            $post->slug = $request->input('slug');
            $post->excerpt = $request->input('excerpt');
            $post->body = $request->input('body');
            $post->author_id = \Auth::user()->id;
            if($request->input('publish') == "on") {
                $post->status = "PUBLISHED";
            }
            $post->save();
            return redirect('/app/content');
        }


        return view('app.post.add')->with('categories', $categories);
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