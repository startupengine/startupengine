<?php

namespace App;

use App\Http\Resources\Page;
use App\User;
use Carbon\Carbon;
use App\Category;
use ElfSundae\Laravel\Hashid\Facades\Hashid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\Page as PageResource;

class APIResponse extends Model
{

    public function getUsers(Request $request, $perPage = 10, $limit = 10, $pageNumber = 1, $sortBy = 'created_at', $sortDirection = 'asc')
    {
        if ($request->input('perPage') !== null) {
            $perPage = $request->input('perPage');
        }

        $users = User::whereNotNull('status');
        $totalUsers = User::whereNotNull('status');
        if ($request->input('filters') !== null) {
            foreach ($request->input('filters') as $filter => $value) {
                $array = ['name' => $filter, 'value' => explode(',', $value)];
                if (count($array['value']) == 1) {
                    $users->where($array['name'], '=', $array['value'][0]);
                    $totalUsers->where($array['name'], '=', $array['value'][0]);
                }
                if (count($array['value']) == 2) {
                    $users->where($array['name'], $array['value'][1], $array['value'][0]);
                    $totalUsers->where($array['name'], $array['value'][1], $array['value'][0]);
                }
                if (count($array['value']) == 3 && $array['value'][2] == true) {
                    $users->where($array['name'], $array['value'][1], '%' . $array['value'][0] . '%');
                    $totalUsers->where($array['name'], $array['value'][1], '%' . $array['value'][0] . '%');
                }
            }
        }

        $users = $users->simplePaginate($perPage);
        $totalUsers = $totalUsers->get();

        $users->transform(function ($item, $key) {
            $item->member_since = $item->created_at->diffForHumans();
            $item->last_active = $item->updated_at->diffForHumans();
            $item->avatar = $item->avatar();
            return $item;
        });

        $response = json_decode(json_encode($users));
        $response->total = count($totalUsers);
        $response->pages = ceil($response->total / $response->per_page);
        return $response;
    }


    public function getContentModels(Request $request, $perPage = 10, $limit = 10, $pageNumber = 1, $sortBy = 'created_at', $sortDirection = 'asc')
    {
        if ($request->input('perPage') !== null) {
            $perPage = $request->input('perPage');
        }
        $models = PostType::orderBy($sortBy, $sortDirection)->limit($limit)->simplePaginate($perPage);
        $totalModels = PostType::orderBy($sortBy, $sortDirection)->get();
        $models->transform(function ($item, $key) {
            $item->member_since = $item->created_at->diffForHumans();
            $item->last_active = $item->updated_at->diffForHumans();
            return $item;
        });
        $response = json_decode(json_encode($models));
        $response->total = count($totalModels);
        $response->pages = ceil($response->total / $response->per_page);
        return $response;
    }


    public function getStripePlans($request)
    {
        if ($request->input('product_id') !== null) {
            $plans = getStripePlans($request->input('product_id'));
        } else {
            $plans = getStripePlans();
        }
        return response()
            ->json($plans);
    }

    public function getStripeProducts($request)
    {
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $products = \Stripe\Product::all(array("limit" => 100));
        foreach ($products->data as $product) {
            $item = \App\Product::where('stripe_id', '=', $product->id)->first();
            if ($item == null) {
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

    public function createProduct($request)
    {
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $product = \Stripe\Product::create(array(
            "name" => $request->input('name'),
            "type" => "service"
        ));
        return response()
            ->json($product);
    }

    public function findProduct($request, $id)
    {
        $product = Product::find($id);
        $json = json_decode($product->json);
        $product->content = $product->content();
        $product->schema = $product->schema();
        $product->tags = $product->tagNames();

        $response = ["data"=>(json_decode(json_encode($product->toArray()))), "status" => "success"];

        return response()
            ->json($response);
    }

    public function createProductPlan($request)
    {
        $plan = createProductPlan($request);
        return response()
            ->json($plan);
    }

    public function createSubscription($request)
    {
        $user = User::find($request->input('user_id'));
        $plan_id = $request->input('plan_id');
        $newplan = $user->newSubscription('main', $plan_id)->create($request->input('token'));
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $stripeplan = \Stripe\Plan::retrieve($plan_id);
        $newplan->price = $stripeplan->amount;
        $newplan->json = json_encode($stripeplan);
        $newplan->save();
        $event = new AnalyticEvent();
        $event->event_type = 'subscription purchased';
        $event->user_id = $user->id;
        $event->user_email = $user->email;
        $event->user_name = $user->name;
        $event->event_data = json_encode("{\"plan_id\":$plan_id, \"amount\":'" . $newplan->amount . "'}");
        $event->save();
        return response()
            ->json($newplan);
    }

    public function getInvoices($id)
    {
        $user = User::find($id);
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $invoices = \Stripe\Invoice::all(array("customer" => $user->stripe_id, "limit" => 10));
        return response()
            ->json($invoices);
    }

    public function newItem($request)
    {

        if ($request->input('title') != null) {
            $title = $request->input('title');
        }
        if ($request->input('type') != null) {
            $type = \App\PostType::where('slug', '=', $request->input('type'))->first();
        }

        if (isset($type) && isset($title)) {
            $record = new \App\Post();
            $record->title = $request->input("title");
            $record->post_type = $type->slug;
            $record->slug = createSlug($record->title);
            $record->author_id = 0;
            $record->save();

            $response = [];
            $response['status'] = 'success';
            $response['data'] = $record;
        } else {
            $response = [];
            $response['status'] = 'error';
            $response['message'] = 'Something went wrong. Product was not created.';
        }
        return $response;
    }

    public function getItems($request)
    {
        $search = $request->input('s');
        $type = $request->input('type');
        $posttype = $request->input('post_type');
        if ($type == null) {
            $type = 'posts';
        }
        if ($type == 'posts' && $posttype == null) {
            $posttype = 'post';
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

        if ($request->input('tag') !== null) {
            $tags = $request->input('tag');
        } else {
            $tags = null;
        }

        if ($request->input('excludeTag') !== null) {
            $excludedTags = explode(',', $request->input('excludeTag'));
        } else {
            $excludedTags = [];
        }

        if ($tags !== null && $tags !== '' && $search !== null) {
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
        } elseif ($tags !== null && $tags !== '' && $search == null) {
            $items = Post::select(\DB::raw($fields))
                ->where('status', '=', 'PUBLISHED')
                ->where('post_type', '=', $posttype)
                ->limit($limit)
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<', Carbon::now()->toDateTimeString())
                ->withAnyTag($tags)
                ->withoutTags($excludedTags)
                ->jsonPaginate();
        } else {
            if (isset($search)) {
                $items = Post::select(\DB::raw($fields))
                    ->where('status', '=', 'PUBLISHED')
                    ->where('post_type', '=', $posttype)
                    ->where('title', 'ILIKE', "%$search%")
                    ->limit($limit)
                    ->orderBy('published_at', 'desc')
                    ->where('published_at', '<', Carbon::now()->toDateTimeString())
                    ->jsonPaginate();
            } else {
                $items = Post::select(\DB::raw($fields))
                    ->where('status', '=', 'PUBLISHED')
                    ->where('post_type', '=', $posttype)
                    ->limit($limit)
                    ->orderBy('published_at', 'desc')
                    ->where('published_at', '<', Carbon::now()->toDateTimeString())
                    ->jsonPaginate();
            }
        }

        /*foreach($items as $item) {
            $item->views = count($item->views());
        }*/

        //$items = $items->sortBy('views')->reverse();

        $items->transform(function ($item, $key) {
            if (isset($item->slug)) {
                $item->slug = $item->slug;
            }
            if ($item->content() !== null) {
                $item->content = $item->content();
            }
            $item->content = $item->json();
            $item->views = count($item->views());
            $item->user = $item->user();
            $item->tags;
            return $item;
        });

        //$items = $items->sortBy('views')->reverse();

        //$items = $items->sortBy('views')->reverse();

        $response = (json_decode(json_encode($items->toArray())));

        return response()
            ->json($response);
    }

    public function getRandomItem($request)
    {
        $type = $request->input('post_type');
        if ($type == null) {
            $type = 'posts';
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

    public function findItem($request, $id)
    {

        $post = Post::find($id);
        $json = json_decode($post->json);
        $post->content = $json;
        $post->schema = $post->schema();
        $post->tags = $post->tags;

        $response = ["data"=>(json_decode(json_encode($post->toArray()))), "status" => "success"];

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
            $item->slug = $item->slug;
            return $item;
        });

        $response = (json_decode(json_encode($items->toArray())));

        return response()
            ->json($response);
    }

    public function getPage($input)
    {
        if (is_numeric($input)) {
            $page = \App\Page::where('id', '=', $input)->firstOrFail();
        } else {
            $page = \App\Page::where('slug', '=', $input)->firstOrFail();
        }

        $resource = new PageResource($page);
        $page = $resource->resource;
        //dd($resource->response()->header('X-Value', 'True'));
        //dd($resource->resource);
        if ($page !== null) {
            //return $page;
            return $resource->response();
        }
    }

    public function editPage(Request $request, $input)
    {

        if (is_numeric($input)) {
            $page = \App\Page::where('id', '=', $input)->firstOrFail();
        } else {
            $page = \App\Page::where('slug', '=', $input)->firstOrFail();
        }

        $response = $page->validateInput($request);


        $resource = new PageResource($page);
        $page = $resource->resource;
        $page->schema = $page->schema();
        $response['data'] = $page;

        if ($page !== null) {
            //return $resource->response();
            return $response;
        }
    }

    public function getPageById($id)
    {
        $page = Page::where('id', '=', $id)->where('status', '=', 'ACTIVE')->firstOrFail();
        if ($page !== null) {
            return $page;
        }
    }

    public function getPages(Request $request, $perPage = 10, $limit = 10, $pageNumber = 1, $sortBy = 'updated_at', $sortDirection = 'desc')
    {
        if ($request->input('perPage') !== null) {
            $perPage = $request->input('perPage');
        }

        $pages = \App\Page::whereNotNull('status');
        $totalPages = \App\Page::whereNotNull('status');
        if ($request->input('filters') !== null) {
            foreach ($request->input('filters') as $filter => $value) {
                $array = ['name' => $filter, 'value' => explode(',', $value)];
                if (count($array['value']) == 1) {
                    $pages->where($array['name'], '=', $array['value'][0]);
                    $totalPages->where($array['name'], '=', $array['value'][0]);
                }
                if (count($array['value']) == 2) {
                    $pages->where($array['name'], $array['value'][1], $array['value'][0]);
                    $totalPages->where($array['name'], $array['value'][1], $array['value'][0]);
                }
                if (count($array['value']) == 3 && $array['value'][2] == true) {
                    $pages->where($array['name'], $array['value'][1], '%' . $array['value'][0] . '%');
                    $totalPages->where($array['name'], $array['value'][1], '%' . $array['value'][0] . '%');
                }
            }
        }

        $pages = $pages->simplePaginate($perPage);
        $totalPages = $totalPages->get();

        $pages->transform(function ($item, $key) {
            $item->last_updated = $item->updated_at->diffForHumans();
            return $item;
        });
        $response = json_decode(json_encode($pages));
        $response->total = count($totalPages);
        $response->pages = ceil($response->total / $response->per_page);
        if ($response->pages == 0) {
            $response->pages = 1;
        }
        return $response;
    }

    public function getPosts(Request $request, $perPage = 10, $limit = 10, $pageNumber = 1, $sortBy = 'updated_at', $sortDirection = 'desc')
    {
        if ($request->input('perPage') !== null) {
            $perPage = $request->input('perPage');
        }

        $posts = Post::whereNotNull('status');
        $totalPosts = Post::whereNotNull('status');
        if ($request->input('filters') !== null) {
            foreach ($request->input('filters') as $filter => $value) {
                $array = ['name' => $filter, 'value' => explode(',', $value)];
                if (count($array['value']) == 1) {
                    $posts->where($array['name'], '=', $array['value'][0]);
                    $totalPosts->where($array['name'], '=', $array['value'][0]);
                }
                if (count($array['value']) == 2) {
                    $posts->where($array['name'], $array['value'][1], $array['value'][0]);
                    $totalPosts->where($array['name'], $array['value'][1], $array['value'][0]);
                }
                if (count($array['value']) == 3 && $array['value'][2] == true) {
                    $posts->where($array['name'], $array['value'][1], '%' . $array['value'][0] . '%');
                    $totalPosts->where($array['name'], $array['value'][1], '%' . $array['value'][0] . '%');
                }
            }
        }

        if ($request->input('sortBy') !== null && $request->input('sortDirection') == null) {
            $posts->orderBy($request->input('sortBy'), 'desc');
        }
        if ($request->input('sortBy') !== null && $request->input('sortDirection') !== null) {
            $posts->orderBy($request->input('sortBy'), $request->input('sortDirection'));
        }

        if ($request->input('s') !== null) {
            $posts->where('title', 'ILIKE', '%' . $request->input('s') . '%');
            $totalPosts->where('title', 'ILIKE', '%' . $request->input('s') . '%');
        }

        if ($request->input('showDeleted') == 'true') {
            $posts->withTrashed();
            $totalPosts->withTrashed();
        }

        $posts = $posts->simplePaginate($perPage);
        $totalPosts = $totalPosts->get();

        $posts->transform(function ($item, $key) {
            if ($item->updated_at !== null) {
                $item->last_updated = $item->updated_at->diffForHumans();
                $item->tags = $item->tags;
                $item->content = json_decode($item->json);
            }
            return $item;
        });
        $response = json_decode(json_encode($posts));
        $response->total = count($totalPosts);
        $response->pages = ceil($response->total / $response->per_page);
        if ($response->pages == 0) {
            $response->pages = 1;
        }
        return $response;
    }

    public function getProductPlans(Request $request)
    {
        if ($request->input('product_id') !== null) {
            $response = [];
            $product = \App\Product::where('id', '=', $request->input('product_id'))->first();
            if ($product == null) {
                $response['status'] = 'error';
                $response['message'] = 'Product not found.';
            } else {
                $plans = $product->plans();
                $response['status'] = 'success';
                $response['message'] = 'Product found.';
                $response['total'] = count($plans);
                $response['pages'] = 1;
                $response['data'] = $plans;
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Product ID not supplied.';
        }
        return $response;
    }

    public function getProductPlanSchema()
    {
        $plan = new \App\Plan;
        return $plan->schema();
    }

    public function editProductPlans(Request $request)
    {
        $productId = $request->input('product_id');
        if ($request->input('newItem') != null) {
            $newItemJson = json_decode($request->input('newItem'), true);
            if ($newItemJson != null) {
                $validatedData = \Validator::make($newItemJson, [
                    'name' => 'required|max:255',
                    'description' => 'required',
                    'price' => 'numeric|required',
                    'interval' => ['required', Rule::in(['day', 'week', 'month', 'year'])],
                    ]);
                if ($validatedData->passes()) {
                    $response['status'] = 'success';
                    $response['message'] = 'Input is valid.';
                    if ($validatedData->passes()) {
                        $newItem = new \App\Plan;

                        if ($request->input('save') == 'true') {
                            $newItem = \App\Plan::create($validatedData->valid());
                            $newItem->product_id = $request->input('product_id');
                            $newItem->save();
                            $response['status'] = 'success';
                            $response['message'] = 'New item saved.';
                        }
                    }
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Input has errors.';
                    foreach ($validatedData->valid() as $key => $invalidField) {
                        $response['data']['fields'][$key]['valid'] = true;
                        $response['data']['fields'][$key]['first_error'] = null;
                    }
                    foreach ($validatedData->invalid() as $key => $invalidField) {
                        $response['data']['fields'][$key]['valid'] = false;
                        $response['data']['fields'][$key]['first_error'] = $validatedData->errors($key)->first();
                    }
                }
                return $response;
            }
        }

        $planId = $request->input('plan_id');
        if ($productId) {
            $response = [];
            $product = \App\Product::where('id', '=', $request->input('product_id'))->first();
            if ($product == null) {
                $response['status'] = 'error';
                $response['message'] = 'Product not found.';
            } else {
                if ($request->input('new') == 'true' && $request->input('name') != null  && $request->input('price') != null && $request->input('interval') != null) {
                    $plan = new \App\Plan;
                    $plan->save();
                    \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
                    $stripePlan = \Stripe\Plan::create(array(
                        "amount" => $request->input('price'),
                        "interval" => $request->input('interval'),
                        "product" => array(
                            "name" => $request->input('name')
                        ),
                        "currency" => "usd",
                        "id" => $plan->id
                    ));

                    $plan->stripe_id = $stripePlan->id;
                    $plan->remote_data = json_encode($stripePlan);
                    $plan->product_id = $request->input('product_id');
                    $plan->save();
                } else {
                    $plan = \App\Plan::where('id', '=', $planId)->where('product_id', '=', $productId)->first();
                }
                if ($plan != null) {
                    $schema = json_decode(json_encode($plan->schema()), true);
                    if ($request->input('delete') == 'true') {
                        $plan->delete();
                    } else {
                        foreach ($schema['fields'] as $field => $value) {
                            if ($request->input($field) != null) {
                                $plan->$field = $request->input($field);
                                $response['data']['fields'][$field]['valid'] = true;
                                $response['data']['fields'][$field]['errors'] = json_decode(json_encode('{}'));
                                $response['data']['fields'][$field]['first_error'] = null;
                            }
                        }
                    }

                    if ($request->input('save') == 'true') {
                        $plan->save();
                    }
                }
                /*
                $hasvalidations = array_key_exists("validations", $schemaFieldDefinition);
                if ($hasvalidations) {
                    $validations = $schemaFieldDefinition["validations"];
                    $validationParameters = convertSchemaToValidationArray($field, $validations);
                    $input = [strtolower($field) => $value];
                    $validator = \Validator::make($input, $validationParameters);
                    $newArray[] = ['json->' . convertDotsToArrows($field), $value];
                    $response['data']['fields'][$field]['valid'] = $validator->passes();
                    $response['data']['fields'][$field]['errors'] = $validator->errors($field);
                    $response['data']['fields'][$field]['first_error'] = $validator->errors($field)->first();
                    foreach ($response['data']['fields'] as $field => $result) {
                        if ($result['valid'] == false) {
                            $errors[$field] = "Error";
                        }
                    }
                } else {
                    $newArray[] = ['json->' . convertDotsToArrows($field), $value];
                }
                */

                $response['status'] = 'success';
                $response['message'] = 'Product found.';
                $response['total'] = count($plan);
                $response['pages'] = 1;
                //$response['data'] = $plan;
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Product ID not supplied.';
        }
        return $response;
    }

    public function getProducts(Request $request, $perPage = 10, $limit = 10, $pageNumber = 1, $sortBy = 'created_at', $sortDirection = 'asc', $showDeleted = false)
    {
        updateSubscriptionPlans();

        if ($request->input('perPage') !== null) {
            $perPage = $request->input('perPage');
        }

        $products = \App\Product::whereNotNull('status');
        $totalProducts = \App\Product::whereNotNull('status');
        if ($request->input('filters') !== null) {
            foreach ($request->input('filters') as $filter => $value) {
                $array = ['name' => $filter, 'value' => explode(',', $value)];
                if (count($array['value']) == 1) {
                    $products->where($array['name'], '=', $array['value'][0]);
                    $totalProducts->where($array['name'], '=', $array['value'][0]);
                }
                if (count($array['value']) == 2) {
                    $products->where($array['name'], $array['value'][1], $array['value'][0]);
                    $totalProducts->where($array['name'], $array['value'][1], $array['value'][0]);
                }
                if (count($array['value']) == 3 && $array['value'][2] == true) {
                    $products->where($array['name'], $array['value'][1], '%' . $array['value'][0] . '%');
                    $totalProducts->where($array['name'], $array['value'][1], '%' . $array['value'][0] . '%');
                }
            }
        }

        if ($request->input('sortBy') !== null && $request->input('sortDirection') == null) {
            $products->orderBy($request->input('sortBy'), 'desc');
        }
        if ($request->input('sortBy') !== null && $request->input('sortDirection') !== null) {
            $products->orderBy($request->input('sortBy'), $request->input('sortDirection'));
        }

        if ($request->input('s') !== null) {
            $products->where('name', 'ILIKE', '%' . $request->input('s') . '%');
            $totalProducts->where('name', 'ILIKE', '%' . $request->input('s') . '%');
        }
        if ($request->input('showDeleted') == 'true') {
            $products->withTrashed();
            $totalProducts->withTrashed();
        }

        $products = $products->simplePaginate($perPage);
        $totalProducts = $totalProducts->get();

        $products->transform(function ($item, $key) {
            if ($item->updated_at !== null) {
                $item->last_updated = $item->updated_at->diffForHumans();
                $item->tags = $item->tags;
                $item->content = json_decode($item->json);
            }
            return $item;
        });
        $response = json_decode(json_encode($products));
        $response->total = count($totalProducts);
        $response->pages = ceil($response->total / $response->per_page);
        if ($response->pages == 0) {
            $response->pages = 1;
        }
        return $response;
    }

    public function editProduct($request, $id)
    {

        if ($request->input('undelete') != null) {
            $item = \App\Product::where('id', '=', $id)->withTrashed()->first();
        } else {
            $item = \App\Product::where('id', '=', $id)->first();
        }
        $schema = $item->schema();
        $jsonInput = json_decode($request->input('json'), true);
        $response = [];

        $tags = json_decode($request->input('tags'));
        if ($tags !== null) {
            foreach ($tags as $action => $tag) {
                if ($action == 'add') {
                    $item->tag($tag);
                }
                if ($action == 'untag') {
                    $item->untag($tag);
                }
            }
        }

        if ($request->input('undelete') == 'true') {
            $item->restore();
            $item->status = 'INACTIVE';
            $item->save();
            $response["status"] = "success";
            $response["message"] = "Product restored.";
            $response['data'] = $item;
            $item->content = $item->content();
            $item->schema = $item->schema();
            return $response;
        }

        if ($jsonInput == null && $request->input('title') == null && $request->input('slug') == null && $request->input('status') == null) {
            $response["status"] = "pending";
            $response["message"] = "No input.";
            $response['data'] = null;
            return $response;
        }
        $newArray = [];
        $errors = [];
        if ($jsonInput !== null) {
            foreach ($jsonInput as $field => $value) {
                if (strpos($field, '.') !== false) {
                    $arrayIndexes = explode(".", $field);
                }
                $schemaFieldDefinition = (get_array_value(json_decode(json_encode($schema), true), $arrayIndexes));

                if ($schemaFieldDefinition == false) {
                    $schemaFieldDefinition = [];
                }

                $hasvalidations = array_key_exists("validations", $schemaFieldDefinition);
                if ($hasvalidations) {
                    $validations = $schemaFieldDefinition["validations"];
                    $validationParameters = convertSchemaToValidationArray($field, $validations);
                    $input = [strtolower($field) => $value];
                    $validator = \Validator::make($input, $validationParameters);
                    $newArray[] = ['json->' . convertDotsToArrows($field), $value];
                    $response['data']['fields'][$field]['valid'] = $validator->passes();
                    $response['data']['fields'][$field]['errors'] = $validator->errors($field);
                    $response['data']['fields'][$field]['first_error'] = $validator->errors($field)->first();
                    foreach ($response['data']['fields'] as $field => $result) {
                        if ($result['valid'] == false) {
                            $errors[$field] = "Error";
                        }
                    }
                } else {
                    $newArray[] = ['json->' . convertDotsToArrows($field), $value];
                }
            }
        }

        if (count($errors) > 0) {
            $response["status"] = "error";
            $response["message"] = "Validation failed.";
        } else {
            $response["message"] = "Validation successful.";
            if ($request->input('save') != null) {
                foreach ($newArray as $field => $data) {
                    if ($data[1] == 'null' or $data[1] == '') {
                        $data[1] = null;
                    }
                    $item->forceFill([
                        $data[0] => $data[1]
                    ]);
                }
                if ($request->input('slug') !== null) {
                    $item->slug = createSlug($request->input('slug'));
                }
                if ($request->input('title') !== null) {
                    $item->name = $request->input('title');
                }
                if ($request->input('status') !== null) {
                    if (strtolower($request->input('status')) == 'active' or strtolower($request->input('status')) == 'inactive') {
                        $item->status = strtoupper($request->input('status'));
                    }
                }

                if ($request->input('delete') == 'true') {
                    $item->delete();
                } else {
                    $item->save();
                }

                $response["message"] = "Input saved.";
            }
            $response["status"] = "success";
        }

        return $response;
    }

    public function newProduct($request)
    {

        if ($request->input('name') != null) {
            $name = $request->input('name');
        }
        if ($request->input('type') == 'service' or $request->input('type') == 'good') {
            $type = $request->input('type');
        }

        if (isset($type) && isset($name)) {
            \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
            $product = \Stripe\Product::create(array(
                "name" => $name,
                "type" => $type,
                "description" => null,
                "attributes" => []
            ));
            $record = new \App\Product();
            $record->stripe_id = $product->id;
            if ($type == 'good') {
                $record->json = json_encode(["sections" => ["about" => ["fields" => ["type" => 'Physical Product']]]]);
            }
            if ($type == 'service') {
                $record->json = json_encode(["sections" => ["about" => ["fields" => ["type" => 'Service']]]]);
            }
            $record->name = $request->input("name");
            $record->remote_data = json_encode($product);
            $record->slug = createSlug($record->name);
            $record->save();

            $response = [];
            $response['status'] = 'success';
            $response['data']['url'] = ("/api/products/view/$record->id");
        } else {
            $response = [];
            $response['status'] = 'error';
            $response['message'] = 'Something went wrong. Product was not created.';
        }
        return $response;
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

    public function editItem($request, $id)
    {
        $item = Post::where('id', '=', $id)->first();
        $fields = [];
        if ($request->input() !== null) {
            foreach ($request->input() as $input => $value) {
                $item->$input = $value;
                $fields[] = $input;
            }
        }
        if (count($fields) > 0) {
            $item->save();
        }

        return $item;
    }

    public function validateInput($request, $id)
    {

        if ($request->input('undelete') == 'true' && $request->input('save') == 'true') {
            $item = \App\Post::withTrashed()->find($id);
            $item->restore();
            $item->save();
        } else {
            $item = \App\Post::where('id', '=', $id)->first();
        }


        $schema = json_decode($item->postType()->json, true);
        $jsonInput = json_decode($request->input('json'), true);
        $response = [];



        $tags = json_decode($request->input('tags'));
        if ($tags !== null) {
            foreach ($tags as $action => $tag) {
                if ($action == 'add') {
                    $item->tag($tag);
                }
                if ($action == 'untag') {
                    $item->untag($tag);
                }
            }
        }

        if ($jsonInput == null && $request->input('title') == null && $request->input('slug') == null && $request->input('status') == null && $request->input('delete') == null) {
            $response["status"] = "pending";
            $response["message"] = "No input.";
            $response['data'] = null;
            return $response;
        }
        $newArray = [];
        $errors = [];
        if ($jsonInput !== null) {
            foreach ($jsonInput as $field => $value) {
                if (strpos($field, '.') !== false) {
                    $arrayIndexes = explode(".", $field);
                }
                $schemaFieldDefinition = (get_array_value($schema, $arrayIndexes));
                if ($schemaFieldDefinition == false) {
                    $schemaFieldDefinition = [];
                }

                $hasvalidations = array_key_exists("validations", $schemaFieldDefinition);
                if ($hasvalidations) {
                    $validations = $schemaFieldDefinition["validations"];
                    $validationParameters = convertSchemaToValidationArray($field, $validations);
                    $input = [strtolower($field) => $value];
                    $validator = \Validator::make($input, $validationParameters);
                    $newArray[] = ['json->' . convertDotsToArrows($field), $value];
                    $response['data']['fields'][$field]['valid'] = $validator->passes();
                    $response['data']['fields'][$field]['errors'] = $validator->errors($field);
                    $response['data']['fields'][$field]['first_error'] = $validator->errors($field)->first();
                    foreach ($response['data']['fields'] as $field => $result) {
                        if ($result['valid'] == false) {
                            $errors[$field] = "Error";
                        }
                    }
                } else {
                    $newArray[] = ['json->' . convertDotsToArrows($field), $value];
                }
            }
        }

        if (count($errors) > 0) {
            $response["status"] = "error";
            $response["message"] = "Validation failed.";
        } else {
            $response["message"] = "Validation successful.";
            if ($request->input('save') != null) {
                foreach ($newArray as $field => $data) {
                    $item->forceFill([
                        $data[0] => $data[1]
                    ]);
                }
                if ($request->input('slug') !== null) {
                    $item->slug = createSlug($request->input('slug'));
                }
                if ($request->input('title') !== null) {
                    $item->title = $request->input('title');
                }
                if ($request->input('status') !== null) {
                    if (strtolower($request->input('status')) == 'published' or strtolower($request->input('status')) == 'pending' or strtolower($request->input('status')) == 'private') {
                        $item->status = strtoupper($request->input('status'));
                    }
                }
                if ($request->input('delete') == 'true') {
                    $item->delete();
                } else {
                    $item->save();
                }


                $response["message"] = "Input saved.";
            }
            $response["status"] = "success";
        }

        return $response;
    }
}
