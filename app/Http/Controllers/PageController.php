<?php

namespace App\Http\Controllers;

use App\ContentItem;
use App\Setting;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\Role;

class PageController
{

    public function getHomepage()
    {
        dd(bcrypt('IAmJHC333'));
        $homepagesetting = Setting::where('key', '=', 'site.homepage')->first();
        if($homepagesetting !== null){
            $page = \App\Page::where('slug', '=', $homepagesetting->value)->where('status','=', 'ACTIVE')->first();
        }
        else {
            $page = \App\Page::where('slug', '=', 'home')->where('status', '=', 'ACTIVE')->first();
        }
        if($page == null) {
            return redirect('/login');
        }
        else {
            return view('pages.view')->with('page', $page);
        }
    }

    public function getPage($slug)
    {
        $page = \App\Page::where('slug', '=', $slug)->where('status', '=', 'ACTIVE')->first();
        if ($page == null) {
            abort(404);
        }
        return view('pages.view')->with('page', $page);
    }

    public function addPage(Request $request)
    {

        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $page = new \App\Page();
            $page->schema = null;
            return view('app.page.edit')->with('page', $page);
        } else {
            abort(404);
        }
    }


    public function editPage(Request $request, $id)
    {

        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            $page = \App\Page::find($id);
            //$page = json_decode(json_encode($page->json()), true);
            //dd($page);
            return view('app.page.edit')->with('page', $page);
        } else {
            abort(404);
        }
    }

    public function savePage(Request $request)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            //dd($request->input());
            if ($request->input('id') !== null) {
                $page = \App\Page::find($request->input('id'));
            } else {
                $page = new \App\Page;
            }
            if($page->author_id == null ) {
                $page->author_id = \Auth::user()->id;
            }
            $page->title = $request->input('title');
            $page->slug = $request->input('slug');
            $page->excerpt = $request->input('excerpt');
            $page->meta_description = $request->input('meta_description');
            $page->css = $request->input('css');
            $page->scripts = $request->input('scripts');
            $page->html = $request->input('html');
            $page->show_footer = $request->input('show_footer');
            if($request->input('json') !== null ){
                $page->json = json_encode($request->input('json'));
            }
            if($request->has('schema')){
                $page->schema = json_encode($request->input('schema'));
            }
            if($request->input('scripts') !== null ){
                $page->scripts = $request->input('scripts');
            }
            if($request->input('css') !== null ){
                $page->css = $request->input('css');
            }
            if($request->input('html') !== null ){
                $page->html = $request->input('html');
            }
            if ($request->input('status') == null) {
                $page->status = 'DRAFT';
            }
            else {
                $page->status = $request->input('status');
            }
            if ($request->input('publish') == "on") {
                $page->status = "PUBLISHED";
            }
            if ($request->input('show_footer') == "on") {
                $page->show_footer = true;
            }
            else {
                $page->show_footer = false;
            }
            $page->save();
            return redirect('/app/pages');
        } else {
            abort(500);
        }
    }

    public function index(Request $request)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            if ($request->input('s') !== null) {
                $pages = \App\Page::where('body', 'LIKE', '%' . $request->input('s') . '%')->orWhere('title', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('excerpt', 'ILIKE', '%' . $request->input('s') . '%')->limit(100)->orderBy('updated_at', 'desc')->get();
            } else {
                $pages = Page::orderBy('created_at', 'desc')->limit(100)->get();
            }
            return view('app.page.index')->with('pages', $pages);
        } else {
            abort(404);
        }
    }

}