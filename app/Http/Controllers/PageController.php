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
    public function index(Request $request)
    {
        return view('admin.pages.index');
    }

    public function view(Request $request, $id)
    {
        $item = \App\Page::find($id);
        $item->schema = $item->schema();

        $options = [
            'id' => $item->id,
            'type' => 'page',
            'index_uri' => '/admin/pages',
            'buttons' => [
                'top_nav' => [
                    'View' => [
                        'link' => '/' . $item->slug,
                        'class' => 'btn btn-dark',
                        'text' =>
                            '<i class="material-icons mr-2">search</i>View',
                        'target' => '_blank'
                    ]
                ]
            ]
        ];
        //dd($item->standardSchema());
        return view('admin.components.resource_view')
            ->with('item', $item)
            ->with('options', $options);
    }

    public function getHomepage()
    {
        $homepagesetting = Setting::where('key', '=', 'site.homepage')->first();

        if ($homepagesetting !== null) {
            $page = \App\Page::where('slug', '=', $homepagesetting->value)
                ->where('status', '=', 'ACTIVE')
                ->first();
        } else {
            $page = \App\Page::where('slug', '=', 'home')
                ->where('status', '=', 'ACTIVE')
                ->first();
        }

        if ($page == null && hasLandingPage() == true) {
            $page = new \App\Page();
            $page->addAnalyticEvent('page viewed');
            $page->json =
                '{"sections":{"heading":{"fields":{"headline":"Open-source startup automation."}}}}';
            return view(defaultPage())->with('page', $page);
        }

        if ($page == null) {
            return redirect('/login');
        } else {
            $page->addAnalyticEvent('page viewed');
            if ($page->isDefaultPage() == true) {
                return view('pages.view')->with('page', $page);
            } else {
                return view(defaultPage())->with('page', $page);
            }
        }
    }

    public function getPage($slug)
    {
        /*$products = \App\Product::where('status', 'ACTIVE')
            ->where(
                'json->sections->about->fields->type',
                'Software Subscription'
            )
            ->get();*/
        //dd($products);
        $page = \App\Page::where('slug', '=', $slug)
            ->where('status', '=', 'ACTIVE')
            ->first();
        if ($page == null) {
            $page = new \App\Page();
            $page->addAnalyticEvent('page viewed');
            if ($slug == 'features') {
                if (
                    hasSubscriptionProductsForSale() &&
                    count(getSubscriptionProducts()) == 1 &&
                    count(\App\Feature::all()) == 0
                ) {
                    $product = getSubscriptionProducts()[0];
                    return redirect('/products/' . $product->stripe_id);
                }
            }
            if (view()->exists('pages.defaults.' . $slug . '.index')) {
                if ($slug == 'pricing') {
                    if (hasSubscriptionProductsForSale() == false) {
                        abort(404);
                    }
                }
                $page->json = "{}";
                return view('pages.defaults.' . $slug . '.index')->with(
                    'page',
                    $page
                );
            }
            abort(404);
        }
        $page->content = $page->content();
        $page->addAnalyticEvent('page viewed');
        return view('pages.view')->with('page', $page);
    }

    public function addPage(Request $request)
    {
        $page = new \App\Page();
        $page->schema = null;
        return view('app.page.add')->with('page', $page);
    }

    public function savePage(Request $request)
    {
        //dd(json_decode($request->input('tags')));
        if ($request->input('id') !== null) {
            $page = \App\Page::find($request->input('id'));
        } else {
            $page = new \App\Page();
        }
        $page->title = $request->input('title');
        $page->slug = $request->input('slug');

        $page->excerpt = $request->input('excerpt');
        $page->meta_description = $request->input('meta_description');

        $tags = json_decode($request->input('tags'));
        if ($request->input('tags') !== null && $tags == true) {
            $page->untag();
            foreach ($tags as $tag) {
                $page->tag($tag->name);
            }
        }
        //dd($page->tagNames());

        if (
            $request->input('json') !== null &&
            \Auth::user()->hasPermissionTo('edit pages')
        ) {
            $page->json = json_encode($request->input('json'));
            foreach ($request->input('json')['versions'] as $entry => $value) {
                foreach ($page->schema()->sections as $section) {
                    $search = $section->slug;
                    if (array_key_exists($search, $value)) {
                        $newjsonversions[$entry] = $value;
                    }
                }
            }
            $page->json = json_encode(["versions" => $newjsonversions]);
        }
        if (
            $request->has('schema') &&
            \Auth::user()->hasPermissionTo('write code fields')
        ) {
            $page->schema = json_encode($request->input('schema'));
        }
        if (
            $request->has('scripts') &&
            \Auth::user()->hasPermissionTo('write code fields')
        ) {
            $page->scripts = $request->input('scripts');
        }
        if (
            $request->has('css') &&
            \Auth::user()->hasPermissionTo('write code fields')
        ) {
            $page->css = $request->input('css');
        }
        if (
            $request->has('html') &&
            \Auth::user()->hasPermissionTo('write code fields')
        ) {
            $page->html = $request->input('html');
        }
        if (
            $request->has('status') &&
            \Auth::user()->hasPermissionTo('publish pages')
        ) {
            $page->status = $request->input('status');
        } else {
            $page->status = 'DRAFT';
        }
        $event = new AnalyticEvent();
        if (\Auth::user()->hasPermissionTo('write code fields')) {
            $event = new AnalyticEvent();
            if ($page->id !== null) {
                $event->event_type = 'page edited';
            } else {
                $event->event_type = 'page added';
            }
            $page->save();
            $event->user_id = \Auth::user()->id;
            $event->user_email = \Auth::user()->email;
            $event->user_name = \Auth::user()->name;
            $array = [
                "id" => "$page->id",
                "model" => "page",
                "slug" => $page->slug,
                "variation" => $page->content()->meta->slug
            ];
            $event->event_data = json_encode($array);
            $event->save();
        }

        return redirect('/app/pages');
    }

    public function deletePage(Request $request, $id)
    {
        if (\Auth::user()->hasPermissionTo('delete pages')) {
            if ($id !== null) {
                $page = \App\Page::find($id);
                $page->delete();
            }
            return redirect('/app/pages');
        } else {
            abort(500);
        }
    }
}
