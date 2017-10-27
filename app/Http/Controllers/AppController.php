<?php

namespace App\Http\Controllers;

use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Voyager;
use Jaam\Mixpanel\DataExportApi;
use Jaam\Mixpanel\DataExportApiException;

class AppController extends Controller
{

    public function index() {
        $pages =  \App\Page::all();
        $posts =  \App\Post::all();
        $categories =  \App\Category::all();
        $users = \App\User::all();
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        $userlist = [];
        foreach($users as $user) {
            if (!isset($userlist[$user->created_at->toFormattedDateString()])) {
                $userlist[$user->created_at->toFormattedDateString()] = 1;
            } else {
                $userlist[$user->created_at->toFormattedDateString()] = $userlist[$user->created_at->toFormattedDateString()] + 1;
            }
        }
        $postlist = [];
        foreach($posts as $post) {
            if (!isset($postlist[$post->created_at->toFormattedDateString()])) {
                $postlist[$post->created_at->toFormattedDateString()] = 1;
            } else {
                $postlist[$post->created_at->toFormattedDateString()] = $postlist[$post->created_at->toFormattedDateString()] + 1;
            }
        }
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            return view('app.index')->with('pages', $pages)->with('posts', $posts)->with('postlist', $postlist)->with('categories', $categories)->with('users', $users)->with('userlist', $userlist);
        }

        else {
            abort(404);
        }

    }

    public function login() {
        return view('app.login');
    }

    public function insights(Request $request) {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            return view('app.insights');
        }

        else {
            abort(404);
        }

    }

    public function content(Request $request) {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            if($request->input('s') !== null) {
                $posts = \App\Post::where('body', 'LIKE', '%'.$request->input('s').'%')->orWhere('title', 'ILIKE', '%'.$request->input('s').'%')->orWhere('excerpt', 'ILIKE', '%'.$request->input('s').'%')->limit(100)->orderBy('updated_at', 'desc')->get();
            }
            else {
                $posts = \App\Post::limit(100)->orderBy('updated_at', 'desc')->get();
            }
            return view('app.content')->with('posts', $posts);
        }

        else {
            abort(404);
        }

    }

    public function analytics(Request $request) {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            return view('app.analytics');
        }

        else {
            abort(404);
        }

    }

    public function mixpanel(Request $request) {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            return view('app.analytics.mixpanel');
        }

        else {
            abort(404);
        }

    }

    public function users(Request $request) {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            if($request->input('s') !== null) {
                $users = \App\User::where('name', 'LIKE', '%'.$request->input('s').'%')->orWhere('email', 'ILIKE', '%'.$request->input('s').'%')->limit(100)->orderBy('updated_at', 'desc')->get();
            }
            else {
                $users =  \App\User::limit(100)->get();
            }
            return view('app.users')->with('users', $users);
        }

        else {
            abort(404);
        }

    }

    public function settings(Request $request) {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if(\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            if($request->input('s') !== null) {
                $settings = \App\Setting::where('key', 'LIKE', '%'.$request->input('s').'%')->orWhere('display_name', 'ILIKE', '%'.$request->input('s').'%')->orWhere('value', 'ILIKE', '%'.$request->input('s').'%')->limit(100)->orderBy('display_name', 'asc')->get();
            }
            else {
                $settings =  new \App\Setting();
                $settings = $settings->appSettings();
            }
            return view('app.settings')->with('settings', $settings);
        }

        else {
            abort(404);
        }

    }

}