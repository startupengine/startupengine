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
        $fields = 'id, status, title, meta_description, slug, image';
        $items = \DB::table($type)
            ->select(\DB::raw($fields))
            ->where('status', '=', 'PUBLISHED')
            ->where('category_id', '=', $category->id)
            ->limit($limit)
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
        $fields = 'id, status, title, meta_description, slug, image';
        $items = \DB::table($type)
            ->select(\DB::raw($fields))
            ->where('status', '=', 'PUBLISHED')
            ->limit($limit)
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
        $fields = 'id, status';
        if(Schema::hasColumn($type, 'meta_description'))
        {
            $fields = $fields.'meta_description';
        }
        if(Schema::hasColumn($type, 'body'))
        {
            $fields = $fields.', body';
        }
        if(Schema::hasColumn($type, 'image'))
        {
            $fields = $fields.', image';
        }
        if(Schema::hasColumn($type, 'background_image'))
        {
            $fields = $fields.', background_image';
        }
        if(Schema::hasColumn($type, 'name'))
        {
            $fields = $fields.', name';
        }
        if(Schema::hasColumn($type, 'title'))
        {
            $fields = $fields.', title';
        }

        $items = \DB::table($type)
            ->select(\DB::raw($fields))
            ->where('slug', '=', $slug)
            ->where('status', '=', 'PUBLISHED')
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
        $fields = 'id, status, title, meta_description, slug, image';
        $items = \DB::table($type)
            ->select(\DB::raw($fields))
            ->where('status', '=', 'PUBLISHED')
            ->where('body', 'like', '%'.$input.'%')
            ->orWhere('title', 'like', '%'.$input.'%')
            ->limit($limit)
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