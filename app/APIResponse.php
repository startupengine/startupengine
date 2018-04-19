<?php

namespace App;

use App\User;
use Carbon\Carbon;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class APIResponse extends Model
{

    public function getStripePlans($request){
        if($request->input('product_id') !== null ){
            $plans = getStripePlans($request->input('product_id'));
        }
        else {
            $plans = getStripePlans();
        }
        return response()
            ->json($plans);
    }

    public function getStripeProducts($request){
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $products = \Stripe\Product::all(array("limit" => 100));
        foreach($products->data as $product){
            $item = \App\Product::where('stripe_id', '=', $product->id)->first();
            if($item == null){
                $item = new \App\Product();
            }
            $item->stripe_id = $product->id;
            $item->name = $product->name;
            $item->json = json_encode($product);
            $item->save();
        }
        return response()
            ->json($products);
    }

    public function createProduct($request){
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $product = \Stripe\Product::create(array(
            "name" => $request->input('name'),
            "type" => "service"
        ));
        return response()
            ->json($product);
    }

    public function createProductPlan($request){
       $plan = createProductPlan($request);
        return response()
            ->json($plan);
    }

    public function createSubscription($request){
        $user = User::find($request->input('user_id'));
        $plan_id = "plan_ChBLS3BmNRMIgx";
        $newplan = $user->newSubscription('main', $plan_id)->create('tok_1CHmtMGQPPOg9Tbdz2UYxKsD');
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $stripeplan = \Stripe\Plan::retrieve("plan_ChBLS3BmNRMIgx");
        $newplan->price = $stripeplan->amount;
        $newplan->json = json_encode($stripeplan);
        $newplan->save();
        return response()
            ->json($newplan);
    }

    public function getInvoices($id){
        $user = User::find($id);
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $invoices = \Stripe\Invoice::all(array("customer" => $user->stripe_id, "limit" => 10));
        return response()
            ->json($invoices);
    }

    public function getItems($request)
    {
        $search = $request->input('s');
        $type = $request->input('type');
        $posttype = $request->input('post_type');
        if($type == null){$type =  'posts'; }
        if($type == 'posts' && $posttype == null){
            $posttype  = 'post';
        }
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

        if($request->input('tag') !== null) {
            $tags = $request->input('tag');
        }
        else {
            $tags = null;
        }

        if($request->input('excludeTag') !== null) {
            $excludedTags = explode(',', $request->input('excludeTag'));
        }
        else {
            $excludedTags = [];
        }

        if($tags !== null && $tags !== '' && $search !== null) {
            $items = Post::select(\DB::raw($fields))
                ->where('status', '=', 'PUBLISHED')
                ->where('post_type', '=', $posttype)
                ->limit($limit)
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<', Carbon::now()->toDateTimeString())
                ->where('title', 'ILIKE', "%$search%")
                ->withAnyTag($tags)
                ->withoutTags($excludedTags)
                ->jsonPaginate();
        }
        elseif($tags !== null && $tags !== '' && $search == null) {
            $items = Post::select(\DB::raw($fields))
                ->where('status', '=', 'PUBLISHED')
                ->where('post_type', '=', $posttype)
                ->limit($limit)
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<', Carbon::now()->toDateTimeString())
                ->withAnyTag($tags)
                ->withoutTags($excludedTags)
                ->jsonPaginate();
        }
        else {
            $items = Post::select(\DB::raw($fields))
                ->where('status', '=', 'PUBLISHED')
                ->where('post_type', '=', $posttype)
                ->limit($limit)
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<', Carbon::now()->toDateTimeString())
                ->jsonPaginate();
        }

        $items->transform(function ($item, $key) {
            if (isset($item->slug)) {
                $item->slug = '/content/' . $item->slug;
            }
            if($item->content() !== null){
                $item->content = $item->content();
            }
            $item->user = $item->user();
            $item->tags;
            return $item;
        });

        $response = (json_decode(json_encode($items->toArray())));

        return response()
            ->json($response);
    }

    public function getRandomItem($request)
    {
        $type = $request->input('post_type');
        if($type == null){$type =  'posts'; }
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
        $page = Page::where('slug', '=', $slug)->where('status', '=', 'ACTIVE')->firstOrFail();
        if ($page !== null) {
            $versions = json_decode($page->json, true)['versions'];
            $random = $versions[rand(1, count($versions))];
            $page->json = $random;
            return response()
                ->json($page);
        }
    }
}