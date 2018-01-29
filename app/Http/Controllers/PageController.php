<?php

namespace App\Http\Controllers;

use App\AnalyticEvent;
use App\ContentItem;
use App\Setting;
use Illuminate\Http\Request;
use App\Page;
use App\Role;


class PageController
{

    public function getHomepage()
    {
        $homepagesetting = Setting::where('key', '=', 'site.homepage')->first();
        if ($homepagesetting !== null) {
            $page = \App\Page::where('slug', '=', $homepagesetting->value)->where('status', '=', 'ACTIVE')->first();
        } else {
            $page = \App\Page::where('slug', '=', 'home')->where('status', '=', 'ACTIVE')->first();
        }
        $page->content = $page->content();
        $event = new AnalyticEvent();
        $event->event_type = 'page viewed';
        if(\Auth::user()) {
            $event->user_id = \Auth::user()->id;
            $event->user_email = \Auth::user()->email;
            $event->user_name = \Auth::user()->name;
        }
        if($page->content()->meta->slug !== null ){
            $event->event_data = json_encode("{id:$page->id, slug:'$page->slug',title:'$page->title', variation:'".$page->content()->meta->slug."'}");
        }
        else {
            $event->event_data = json_encode("{id:$page->id, slug:'$page->slug',title:'$page->title'}");
        }
        $event->save();
        if ($page == null) {
            return redirect('/login');
        } else {
            return view('pages.view')->with('page', $page);
        }
    }

    public function getPage($slug)
    {
        $page = \App\Page::where('slug', '=', $slug)->where('status', '=', 'ACTIVE')->first();
        if ($page == null) {
            abort(404);
        }
        $page->content = $page->content();
        $event = new AnalyticEvent();
        $event->event_type = 'page viewed';
        if(\Auth::user()) {
            $event->user_id = \Auth::user()->id;
            $event->user_email = \Auth::user()->email;
            $event->user_name = \Auth::user()->name;
        }
        if($page->content()->meta && $page->content()->meta->slug !== null ){
            $event->event_data = json_encode("{id:$page->id, slug:'$page->slug',title:'$page->title', variation:'".$page->content()->meta->slug."'}");
        }
        else {
            $event->event_data = json_encode("{id:$page->id, slug:'$page->slug',title:'$page->title'}");
        }
        $event->save();
        return view('pages.view')->with('page', $page);
    }

    public function addPage(Request $request)
    {
        $page = new \App\Page();
        $page->schema = null;
        return view('app.page.add')->with('page', $page);
    }


    public function editPage(Request $request, $id)
    {
        $page = \App\Page::find($id);
        //dd($page->tagNames());
        return view('app.page.edit')->with('page', $page);
    }

    public function savePage(Request $request)
    {
        //dd(json_decode($request->input('tags')));
        if ($request->input('id') !== null) {
            $page = \App\Page::find($request->input('id'));
        } else {
            $page = new \App\Page;
        }
        $page->title = $request->input('title');
        $page->slug = $request->input('slug');

        $page->excerpt = $request->input('excerpt');
        $page->meta_description = $request->input('meta_description');

        $tags = json_decode($request->input('tags'));
        if($request->input('tags') !== null && $tags == true) {
            $page->untag();
            foreach($tags as $tag){
                $page->tag($tag->name);
            }
        }
        //dd($page->tagNames());

        if ($request->input('json') !== null  && \Auth::user()->hasPermissionTo('edit pages')) {
            $page->json = json_encode($request->input('json'));
            foreach($request->input('json')['versions'] as $entry => $value){
                foreach($page->schema()->sections as $section){
                    $search = $section->slug;
                    if(array_key_exists($search,$value)) {
                        $newjsonversions[$entry] = $value;
                    }
                }
            }
            $page->json = json_encode(["versions" => $newjsonversions]);
        }
        if ($request->has('schema')  && \Auth::user()->hasPermissionTo('write code fields')) {
            $page->schema = json_encode($request->input('schema'));
        }
        if ($request->has('scripts')  && \Auth::user()->hasPermissionTo('write code fields')) {
            $page->scripts = $request->input('scripts');
        }
        if ($request->has('css')  && \Auth::user()->hasPermissionTo('write code fields')) {
            $page->css = $request->input('css');
        }
        if ($request->has('html') && \Auth::user()->hasPermissionTo('write code fields')) {
            $page->html = $request->input('html');
        }
        if ($request->has('status') && \Auth::user()->hasPermissionTo('publish pages')) {
            $page->status = $request->input('status');
        } else {
            $page->status = 'DRAFT';
        }
        $event = new AnalyticEvent();
        if(\Auth::user()->hasPermissionTo('write code fields')) {
            $event = new AnalyticEvent();
            if($page->id !== null) { $event->event_type = 'page edited'; }
            else { $event->event_type = 'page added'; }
            $page->save();
            $event->user_id = \Auth::user()->id;
            $event->user_email = \Auth::user()->email;
            $event->user_name = \Auth::user()->name;
            $event->event_data = json_encode("{id:$page->id}");
            $event->save();
        }

        return redirect('/app/pages');
    }

    public function index(Request $request)
    {
        if ($request->input('s') !== null) {
            $pages = \App\Page::where('body', 'LIKE', '%' . $request->input('s') . '%')->orWhere('title', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('excerpt', 'ILIKE', '%' . $request->input('s') . '%')->limit(100)->orderBy('updated_at', 'desc')->get();
        } else {
            $pages = Page::orderBy('created_at', 'desc')->limit(100)->get();
        }
        return view('app.page.index')->with('pages', $pages);
    }

    public function deletePage(Request $request, $id) {
        if(\Auth::user()->hasPermissionTo('delete pages')) {
            if($id !== null ){
                $page = \App\Page::find($id);
                $page->delete();
            }
            return redirect('/app/pages');
        }
        else { abort(500); }
    }
}