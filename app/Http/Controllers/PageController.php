<?php

namespace App\Http\Controllers;
use App\ContentItem;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\Post;

class PageController extends Controller
{

    public function getHomepage() {
        $page =  Page::where('slug', '=', 'home')->first();
        if ($page == null) {
            abort(404);
        }
        return view('pages.view')->with('page', $page);
    }

    public function getPage($slug) {
        $page =  Page::where('slug', '=', $slug)->first();
        if ($page == null) {
            abort(404);
        }
        return view('pages.view')->with('page', $page);
    }

}