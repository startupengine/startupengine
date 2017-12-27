<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Category;

class APIResponse extends Model
{

    public function getItemsByCategory($request)
    {
        $type = $request->input('type');
        $limit = $request->input('limit');
        if ($limit == null) {
            $limit = 10;
        }
        $category = $request->input('category');
        $category = Category::where('slug', '=', $category)->first();
        $fields = 'id, status, slug';
        if (\Schema::hasColumn($type, 'name')) {
            $fields = $fields . ', name';
        }
        if (\Schema::hasColumn($type, 'title')) {
            $fields = $fields . ', title';
        }
        if (\Schema::hasColumn($type, 'key')) {
            $fields = $fields . ', key';
        }
        if (\Schema::hasColumn($type, 'value')) {
            $fields = $fields . ', value';
        }
        if (\Schema::hasColumn($type, 'display_name')) {
            $fields = $fields . ', display_name';
        }
        if (\Schema::hasColumn($type, 'type')) {
            $fields = $fields . ', type';
        }
        if (\Schema::hasColumn($type, 'post_type')) {
            $fields = $fields . ', post_type';
        }
        if (\Schema::hasColumn($type, 'json')) {
            $fields = $fields . ', json';
        }
        $items = Post::select(\DB::raw($fields))
            ->where('status', '=', 'PUBLISHED')
            ->where('category_id', '=', $category->id)
            ->limit($limit)
            ->orderBy('created_at')
            ->get();
        $items->transform(function ($item, $key) {
            if ($item->image() !== null) {
                $item->image = $item->content()->body->image;
            }
            if (isset($item->slug)) {
                $item->slug = '/content/' . $item->slug;
            }
            return $item;
        });

        $response = (json_decode(json_encode($items->toArray())));

        return response()
            ->json($response);
    }

    public function getItems($request)
    {
        $type = $request->input('type');
        $limit = $request->input('limit');
        if ($limit == null) {
            $limit = 10;
        }
        $fields = 'id, status, slug';
        if (\Schema::hasColumn($type, 'name')) {
            $fields = $fields . ', name';
        }
        if (\Schema::hasColumn($type, 'title')) {
            $fields = $fields . ', title';
        }
        if (\Schema::hasColumn($type, 'key')) {
            $fields = $fields . ', key';
        }
        if (\Schema::hasColumn($type, 'value')) {
            $fields = $fields . ', value';
        }
        if (\Schema::hasColumn($type, 'display_name')) {
            $fields = $fields . ', display_name';
        }
        if (\Schema::hasColumn($type, 'type')) {
            $fields = $fields . ', type';
        }
        if (\Schema::hasColumn($type, 'post_type')) {
            $fields = $fields . ', post_type';
        }
        if (\Schema::hasColumn($type, 'json')) {
            $fields = $fields . ', json';
        }
        $items = Post::select(\DB::raw($fields))
            ->where('status', '=', 'PUBLISHED')
            ->limit($limit)
            ->orderBy('created_at')
            ->where('published_at', '<', Carbon::now()->toDateTimeString())
            ->get();

        $items->transform(function ($item, $key) {
            if (isset($item->slug)) {
                $item->slug = '/content/' . $item->slug;
            }
            if($item->content() !== null){
                $item->content = $item->content();
            }
            return $item;
        });

        $response = (json_decode(json_encode($items->toArray())));



        return response()
            ->json($response);
    }

    public function getRandomItem($request)
    {
        $type = $request->input('type');
        $limit = $request->input('limit');
        if ($limit == null) {
            $limit = 10;
        }
        $fields = 'id, status, slug';
        if (\Schema::hasColumn($type, 'name')) {
            $fields = $fields . ', name';
        }
        if (\Schema::hasColumn($type, 'title')) {
            $fields = $fields . ', title';
        }
        if (\Schema::hasColumn($type, 'key')) {
            $fields = $fields . ', key';
        }
        if (\Schema::hasColumn($type, 'value')) {
            $fields = $fields . ', value';
        }
        if (\Schema::hasColumn($type, 'display_name')) {
            $fields = $fields . ', display_name';
        }
        if (\Schema::hasColumn($type, 'type')) {
            $fields = $fields . ', type';
        }
        if (\Schema::hasColumn($type, 'post_type')) {
            $fields = $fields . ', post_type';
        }
        if (\Schema::hasColumn($type, 'json')) {
            $fields = $fields . ', json';
        }

        $ids = explode(',', $request->input('ids'));
        $items = \DB::table($type)
            ->select(\DB::raw($fields))
            ->where('status', '=', 'PUBLISHED')
            ->whereIn('id', $ids)
            ->where('published_at', '<', Carbon::now()->toDateTimeString())
            ->limit($limit)
            ->orderBy('created_at')
            ->get();

        $items = collect($items->random());

        if (\Schema::hasColumn($type, 'body')) {
            $items->transform(function ($item) {

                if ($item->image() !== null) {
                    $item->image = $item->content()->body->image;
                }
                return $item;
            });
        }

        $response = (json_decode(json_encode($items->toArray())));


        return response()
            ->json($items);
    }

    public function getItem($request)
    {
        $type = $request->input('type');

        if ($request->input('slug') !== null) {
            $field = "slug";
            $slug = $request->input('slug');
        }
        if ($request->input('key') !== null) {
            $field = "key";
            $slug = $request->input('key');
        }

        $fields = 'id, status';

        if (\Schema::hasColumn($type, 'slug')) {
            $fields = $fields . ', slug';
        }
        if (\Schema::hasColumn($type, 'name')) {
            $fields = $fields . ', name';
        }
        if (\Schema::hasColumn($type, 'title')) {
            $fields = $fields . ', title';
        }
        if (\Schema::hasColumn($type, 'key')) {
            $fields = $fields . ', key';
        }
        if (\Schema::hasColumn($type, 'value')) {
            $fields = $fields . ', value';
        }
        if (\Schema::hasColumn($type, 'display_name')) {
            $fields = $fields . ', display_name';
        }
        if (\Schema::hasColumn($type, 'type')) {
            $fields = $fields . ', type';
        }
        if (\Schema::hasColumn($type, 'post_type')) {
            $fields = $fields . ', post_type';
        }
        if (\Schema::hasColumn($type, 'json')) {
            $fields = $fields . ', json';
        }

        $items = Post::select(\DB::raw($fields))
            ->where('status', '=', 'PUBLISHED')
            ->where($field, '=', $slug)
            ->where('published_at', '<', Carbon::now()->toDateTimeString())
            ->get();

        $items->transform(function ($item, $key) {
            if ($item->image() !== null) {
                $item->image = $item->content()->body->image;
            }
            return $item;
        });


        $response = (json_decode(json_encode($items->toArray())));

        return response()
            ->json($response);
    }

    public function search($request)
    {
        $type = $request->input('type');
        $input = $request->input('s');
        $limit = $request->input('limit');
        if ($limit == null) {
            $limit = 10;
        }
        $fields = 'id, status, title, meta_description, slug, image';
        $items = \DB::table($type)
            ->select(\DB::raw($fields))
            ->where('status', '=', 'PUBLISHED')
            ->where('body', 'ILIKE', '%' . $input . '%')
            ->orWhere('title', 'ILIKE', '%' . $input . '%')
            ->orWhere('meta_description', 'ILIKE', '%' . $input . '%')
            ->orWhere('excerpt', 'ILIKE', '%' . $input . '%')
            ->limit($limit)
            ->orderBy('created_at')
            ->get();

        $items->transform(function ($item, $key) {
            $item->image = \Storage::disk('public')->url($item->image);
            $item->slug = '/content/' . $item->slug;
            return $item;
        });

        $response = (json_decode(json_encode($items->toArray())));

        return response()
            ->json($response);
    }

    public function getPage($slug)
    {
        $page = Page::where('slug', '=', $slug)->where('status', '=', 'ACTIVE')->firstOrFail();
        if ($page !== null) {
            return $page;
        }
    }

    public function getRandomPageVariation($request, $slug)
    {
        if ($request->exists('remember')) {
            $cache = $request->input('remember');
        }
        if (isset($cache) && $cache !== null) {
            $page = Page::remember($cache)->where('slug', '=', $slug)->where('status', '=', 'ACTIVE')->firstOrFail();
        } else {
            Page::flushCache();
            $page = Page::where('slug', '=', $slug)->where('status', '=', 'ACTIVE')->firstOrFail();
        }
        if ($page !== null) {
            $versions = json_decode($page->json, true)['versions'];
            $random = $versions[rand(1, count($versions))];
            $page->json = $random;
            return response()
                ->json($page);
        }
    }
}