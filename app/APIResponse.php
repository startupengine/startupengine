<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Category;

class APIResponse extends Model
{

    public function getItemsByCategory($request){
        $type = $request->input('type');
        $limit = $request->input('limit');
        if($limit == null) { $limit = 10; }
        $category = $request->input('category');
        $category = Category::where('slug', '=', $category)->first();

        $items = \DB::table($type)
            ->select(\DB::raw('id, status, title, meta_description, slug, image'))
            ->where('status', '=', 'published')
            ->where('category_id', '=', $category->id)
            ->limit($limit)
            ->groupBy('id, status, title, meta_description, slug, image')
            ->orderBy('created_at')
            ->get();

        $items->transform(function ($item, $key) {
            $item->image = \Storage::disk('public')->url($item->image);
            $item->slug = '/content/'.$item->slug;
            return $item;
        });

        $response = (json_decode(json_encode($items->toArray())));

        return response()
            ->json($response);
    }

    public function getItems($request){
        $type = $request->input('type');
        $limit = $request->input('limit');
        if($limit == null) { $limit = 10; }

        $items = \DB::table($type)
            ->select(\DB::raw('id, status, title, meta_description, slug, image'))
            ->where('status', '=', 'published')
            ->limit($limit)
            ->groupBy('id, status, title, meta_description, slug, image')
            ->orderBy('created_at')
            ->get();

        $items->transform(function ($item, $key) {
            $item->image = \Storage::disk('public')->url($item->image);
            $item->slug = '/content/'.$item->slug;
            return $item;
        });

        $response = (json_decode(json_encode($items->toArray())));

        return response()
            ->json($response);
    }

    public function getItem($request){
        $type = $request->input('type');
        $slug = $request->input('slug');

        $items = \DB::table($type)
            ->select(\DB::raw('*'))
            ->where('slug', '=', $slug)
            ->groupBy('id, status, title, meta_description, slug, image')
            ->orderBy('created_at')
            ->get();


        $items->transform(function ($item, $key) {
            if(isset($item->image)) { $item->image = \Storage::disk('public')->url($item->image); }
            if(isset($item->body)) { $item->body= json_encode($item->body); }
            return $item;
        });

        $response = (json_decode(json_encode($items->toArray())));

        return response()
            ->json($response);
    }

    public function search($request){
        $type = $request->input('type');
        $input = $request->input('s');
        $limit = $request->input('limit');
        if($limit == null) { $limit = 10; }

        $items = \DB::table($type)
            ->select(\DB::raw('id, status, title, meta_description, slug, image'))
            ->where('status', '=', 'published')
            ->where('body', 'like', '%'.$input.'%')
            ->orWhere('title', 'like', '%'.$input.'%')
            ->limit($limit)
            ->groupBy('id, status, title, meta_description, slug, image')
            ->orderBy('created_at')
            ->get();

        $items->transform(function ($item, $key) {
            $item->image = \Storage::disk('public')->url($item->image);
            $item->slug = '/content/'.$item->slug;
            return $item;
        });

        $response = (json_decode(json_encode($items->toArray())));

        return response()
            ->json($response);
    }


}