<?php

namespace App\Http\Controllers;

use App\PostType;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Voyager;
use Jaam\Mixpanel\DataExportApi;
use Jaam\Mixpanel\DataExportApiException;

class AppController extends Controller
{

    public function index()
    {
        return redirect('/app/pages');
        /*
        $pages = \App\Page::all();
        $posts = \App\Post::all();
        $categories = \App\Category::all();
        $users = \App\User::all();
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        $userlist = [];
        foreach ($users as $user) {
            if (!isset($userlist[$user->created_at->toFormattedDateString()])) {
                $userlist[$user->created_at->toFormattedDateString()] = 1;
            } else {
                $userlist[$user->created_at->toFormattedDateString()] = $userlist[$user->created_at->toFormattedDateString()] + 1;
            }
        }
        $postlist = [];
        foreach ($posts as $post) {
            if (!isset($postlist[$post->created_at->toFormattedDateString()])) {
                $postlist[$post->created_at->toFormattedDateString()] = 1;
            } else {
                $postlist[$post->created_at->toFormattedDateString()] = $postlist[$post->created_at->toFormattedDateString()] + 1;
            }
        }
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            return view('app.index')->with('pages', $pages)->with('posts', $posts)->with('postlist', $postlist)->with('categories', $categories)->with('users', $users)->with('userlist', $userlist);
        } else {
            abort(404);
        }*/

    }

    public function login()
    {
        if (\Auth::user()) {
            $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
            if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
                return redirect('/app');
            }
            else {
                return redirect('/');
            }
        } else {
            return view('app.login');
        }
    }

    public function insights(Request $request)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            return view('app.insights');
        } else {
            abort(404);
        }

    }

    public function research(Request $request)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $categories = \App\Category::all();
            $researchitems = \App\ResearchItem::where('user_id', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->limit(3)->get();
            $researchcollections = \App\ResearchCollection::where('user_id', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->limit(3)->get();
            $researchfeeds = \App\ResearchFeed::where('user_id', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->limit(3)->get();
            return view('app.research')->with('categories', $categories)->with('researchitems', $researchitems)->with('researchcollections', $researchcollections)->with('researchfeeds', $researchfeeds);
        } else {
            abort(404);
        }

    }

    public function content(Request $request)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $postTypes = PostType::all();
            if ($request->input('s') !== null) {
                $posts = \App\Post::where('title', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('slug', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('post_type', 'ILIKE', '%' . $request->input('s') . '%')->limit(5)->orderBy('updated_at', 'desc')->get();
            } else {
                $posts = \App\Post::limit(5)->orderBy('updated_at', 'desc')->get();
            }
            return view('app.content')->with('posts', $posts)->with('postTypes', $postTypes);
        } else {
            abort(404);
        }

    }

    public function api(Request $request)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            return view('app.api.tokens');
        } else {
            abort(404);
        }

    }

}