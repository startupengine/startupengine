<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Role;
use GrahamCampbell\Markdown\Facades\Markdown;
use App\PostType;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $postTypes = PostType::all();
        if ($request->input('s') !== null) {
            $posts = \App\Post::where('title', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('slug', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('post_type', 'ILIKE', '%' . $request->input('s') . '%')->limit(100)->orderBy('updated_at', 'desc')->get();
        } else {
            $posts = \App\Post::limit(100)->orderBy('updated_at', 'desc')->get();
        }
        return view('app.post.index')->with('posts', $posts)->with('postTypes', $postTypes);
    }

    public function getPost(Request $request, $slug) {
        $post =  Post::where('slug', '=', $slug)->where('status', '=', 'PUBLISHED')->firstOrFail();
        if(($post->status !== null && $post->published_at->isPast()) OR \Auth::user()) {
            return view('posts.view')->with('post', $post);
        }
        else {
            abort(404);
        }
    }

    public function addPost(Request $request, $slug) {
        $categories = \App\Category::all();
        $post = null;
        $postType = \App\PostType::where('slug', '=', $slug)->where('enabled', '=', true)->firstOrFail();
        return view('app.post.add')->with('categories', $categories)->with('postType', $postType)->with('post', $post);
    }

    public function savePost(Request $request) {

        if(\Auth::user()->hasPermissionTo('edit posts')) {
            if($request->input('id') !== null ){
                $post = \App\Post::find($request->input('id'));
            }
            else {
                $post = new \App\Post;
            }
            if($request->input('published_at') == null) {
                if($post->published_at == null) {
                    $post->published_at = \Carbon\Carbon::now();
                }
            }
            else {
                $date = $request->input('published_at');
                $published_at = \Carbon\Carbon::createFromFormat('m/d/Y', $date);
                $post->published_at = $published_at->toDateTimeString();
            }
            $post->title = $request->input('title');
            $post->slug = $request->input('slug');
            $post->category_id = $request->input('category_id');
            $post->status = $request->input('status');
            $post->author_id = \Auth::user()->id;
            $post->json = json_encode($request->input('json'));
            $post->post_type = $request->input('post_type');
            if($request->input('status') == null) {
                $post->status = 'DRAFT';
            }
            $post->save();
            return redirect('/app/content');
        }

        else { abort(500); }
    }

    public function viewPost(Request $request, $id) {
        $post = Post::find($id);
        if($post == null) {
            abort(404);
        }
        $categories = \App\Category::all();
        $postType = $post->postType();
        return view('app.post.view')->with('post', $post)->with('categories', $categories)->with('postType', $postType);
    }

    public function editPost(Request $request, $id) {
        $post = \App\Post::find($id);
        $categories = \App\Category::all();
        return view('app.post.edit')->with('post', $post)->with('categories', $categories)->with('postType', $post->postType());
    }

    public function deletePost(Request $request, $id) {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {

            if($id !== null ){
                $post = \App\Post::find($id);
                $post->delete();
            }
            return redirect('/app/content');
        }

        else { abort(500); }
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