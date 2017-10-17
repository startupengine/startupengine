<?php

namespace App\Http\Controllers;
use App\ContentItem;
use Illuminate\Http\Request;
use Contentful\Delivery\Client as DeliveryClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\Post;

class HelpController extends Controller
{
    public function index() {
        $page =  Page::where('slug', '=', 'help')->first();
        if ($page == null) {
            abort(404);
        }
        return view('pages.view')->with('page', $page)->with('template', 'help');
    }

    public function getPage($slug) {
        $page =  Page::where('slug', '=', $slug)->first();
        if ($page == null) {
            abort(404);
        }
        return view('help.view')->with('page', $page);
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