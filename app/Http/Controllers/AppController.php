<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Voyager;

class AppController extends Controller
{
    public function index() {
        $pages =  \App\Page::all();
        $posts =  \App\Post::all();
        $categories =  \App\Category::all();
        $users = \App\User::all();
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            return view('app.index')->with('pages', $pages)->with('posts', $posts)->with('categories', $categories)->with('users', $users);
        }

        else {
            abort(404);
        }

    }

    public function content() {
        $pages =  \App\Page::all();
        $posts =  \App\Post::all();
        $categories =  \App\Category::all();
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            //dd($posts);
            return view('app.content')->with('pages', $pages)->with('posts', $posts)->with('categories', $categories);
        }

        else {
            abort(404);
        }

    }

}