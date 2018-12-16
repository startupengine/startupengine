<?php

function get_nested_property($property, $object)
{
    return $object->{$property};
}

function setting($key, $default = null)
{

    $originalKey = $key;
    if (strpos($key, '->') == true) {
        $jsonKey = substr($key, strpos($key, "->") + 2);
        $key = explode("->", $key);
        $string = $key[0];
    } else {
        $string = $key;
    }

    $setting = \App\Setting::where('key', '=', $string)->first();


    if (strpos($originalKey, '->') !== false) {

        $value = $setting->content();
        foreach (explode('->', $jsonKey) as $property) {
            $value = get_nested_property($property, $value);
        }
        return $value;
    } else {
        if ($setting !== null && $setting->value !== null) {
            $output = $setting->value;
        } elseif ($setting == null && $default == null) {
            $output = null;
        } else {
            $output = $default;
        }

        return $output;
    }
}

function findKey($array, $keySearch)
{
    // check if it's even an array
    if (!is_array($array)) return false;

    // key exists
    if (array_key_exists($keySearch, $array)) return true;

    // key isn't in this array, go deeper
    foreach ($array as $key => $val) {
        // return true if it's found
        if (findKey($val, $keySearch)) return true;
    }

    return false;
}

function get_array_value(array $array, array $indexes)
{
    if (count($array) == 0 || count($indexes) == 0) {
        return false;
    }

    $index = array_shift($indexes);
    if (!array_key_exists($index, $array)) {
        return false;
    }

    $value = $array[$index];
    if (count($indexes) == 0) {
        return $value;
    }

    if (!is_array($value)) {
        return false;
    }

    return get_array_value($value, $indexes);

    /* Usage Example
        $some_array = array(["client_name" => ["second_level_index" => ["third_level_index" => 3]] ]);
        $indexes = array(0, 'client_name', 'second_level_index', 'third_level_index');
        $value = get_array_value($some_array, $indexes);
        // Returns 3
    */
}

function convertSchemaToValidationArray($field, $validations)
{
    $array = [];
    foreach ($validations as $validation => $value) {
        $field = str_replace('.', '->', $field);

        if ($validation == "required" && $value == "true") {
            $newvalue = "$validation";
        } elseif ($validation == "numeric" && $value == "true") {
            $newvalue = "$validation";
        } elseif ($validation == "url" && $value == "true") {
            $newvalue = "$validation";
        } else {
            $newvalue = "$validation:$value";
        }

        if (isset($array[strtolower($field)])) {
            $array[strtolower($field)] = $array[strtolower($field)] . "|" . $newvalue;
        } else {
            $array[strtolower($field)] = $newvalue;
        }
    }

    return $array;
}

function convertDotsToArrows($text)
{
    $text = strtolower(str_replace('.', '->', $text));
    return $text;
}

function arrowsToArray($text, $value)
{
    $strings = array($text);
    $nested_array = array();

    $exploded = explode('->', $text);
    $total = count($exploded);

    $count = 1;
    foreach ($strings as $item) {

        $temp = &$nested_array;
        foreach ($exploded as $key) {
            $temp = &$temp[$key];
            $count = $count + 1;
            if ($count == $total) {
                $temp = 'test';
                //dd($exploded[3]);
                //dd($key);
                //dd();
                $temp = [$exploded[$total - 1] => $value];
                $output = $nested_array;

            }
        }
        //$temp = array();
    }

    return $output;
}

function createSlug($str, $delimiter = '-')
{

    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug;

}


function jsonToPrettyString($string)
{
    return ucwords(str_replace("_", " ", $string));
}

function callApi($url)
{
    $request = Request::create($url, 'GET');
    $response = Route::dispatch($request)->getContent();
    return json_decode($response);
}

function button($path, $text, $type = null, $classes = null, $iconmarkup = null, $data = null, $element = null)
{
    if ($type == 'new') {
        $classes = $classes . " btn btn-sm btn-round btn-secondary-outline ";
        $iconmarkup = "&nbsp; <i class=\"fa fa-sm fa-plus-square-o\"></i>";
    }
    if ($type == 'edit') {
        $classes = $classes . " btn btn-sm btn-round btn-secondary-outline ";
        $iconmarkup = "&nbsp; <i class=\"fa fa-sm fa-edit\"></i>";
    }
    if ($type == 'save') {
        $classes = $classes . " btn btn-sm btn-round btn-success ";
        $iconmarkup = "&nbsp; <i class=\"fa fa-sm fa-check-circle-o\"></i>";
    }
    if ($element == null) {
        $element = 'a';
    }

    if ($path !== null) {
        $path = "href=\"$path\"";
    }

    if ($element == 'button') {
        $elementMarkup = 'type="submit"';
    } else {
        $elementMarkup = null;
    }

    $output = "<$element $elementMarkup $path class='$classes' $data>" . ucwords($text) . " $iconmarkup</$element>";
    return $output;
}

function getStripeKeys()
{
    if (config('app.env') == 'local') {
        $key = env('STRIPE_TEST_KEY');
        $secret = env('STRIPE_TEST_SECRET');
    } else {
        $key = env('STRIPE_KEY');
        $secret = env('STRIPE_SECRET');
    }
    return ["key" => $key, "secret" => $secret];
}

function updateSubscriptionProducts()
{
    \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
    $products = \Stripe\Product::all();
    foreach ($products->data as $product) {
        $item = \App\Product::where('stripe_id', '=', $product->id)->first();
        if ($item == null) {
            $item = new \App\Product();
        }
        $item->stripe_id = $product->id;
        $item->name = $product->name;
        $item->remote_data = json_encode($product);
        $item->save();
    }
    $subscriptions = \App\Product::all();
    return $subscriptions;
}

function updateSubscriptionPlans()
{
    \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
    $products = \Stripe\Product::all();
    foreach ($products->data as $product) {
        $item = \App\Product::where('stripe_id', '=', $product->id)->withTrashed()->first();
        if ($item == null) {
            $item = new \App\Product();
        }
        $item->stripe_id = $product->id;
        $item->name = $product->name;
        $item->remote_data = json_encode($product);
        $item->save();
    }
    $subscriptions = \App\Product::all();
    return $subscriptions;
}


function getStripePlans($id = null)
{
    \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
    if ($id !== null) {
        $plans = \Stripe\Plan::all(array("product" => $id));
    } else {
        $plans = \Stripe\Plan::all();
    }
    foreach ($plans->data as $plan) {
        $item = \App\Plan::where('stripe_id', '=', $plan->id)->first();
        if ($item == null) {
            $item = new \App\Plan();
        }
        $item->stripe_id = $plan->id;
        $item->name = $plan->name;
        $item->price = $plan->amount;
        $item->remote_data = json_encode($plan);
        $item->save();
    }
    return $plans;
}

function newStripePlan($name, $productId)
{
    \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
    $plan = \Stripe\Plan::create(array("product" => $productId, "name" => $name));
    return $plan;
}

function createProductPlan($request)
{
    \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
    $plan = \Stripe\Plan::create(array(
        "interval" => $request->input('interval'),
        "currency" => "usd",
        "amount" => $request->input('amount'),
        "product" => $request->input('product_id')
    ));
    $record = new \App\Plan();
    $record->stripe_id = $plan->id;
    $record->name = $plan->nickname;
    $record->remote_data = json_encode($plan);
    $record->save();
    return $record;
}

function valueExists($object, $array = null)
{
    if (isset($object) !== null) {
        return $object;
    } else {
        return null;
    }
}

function mostPopularContent($postType, $limit = null)
{
    if ($limit == null) {
        $posts = \App\Post::where('post_type', '=', $postType)->where('status', '=', 'PUBLISHED')->get();
    } else {
        $posts = \App\Post::where('post_type', '=', $postType)->where('status', '=', 'PUBLISHED')->limit($limit)->get();
    }
    foreach ($posts as $post) {
        $post->views = count($post->views());
    }
    $posts = $posts->sortBy('views')->reverse();
    return $posts;
}

// ******************
// Resource API Logic
// ******************

function isResource($string)
{
    return in_array($string, ['event', 'content', 'log', 'package', 'page', 'permission', 'plan', 'preference', 'preferenceschema', 'product', 'role', 'setting', 'settingsgroup', 'subscription', 'tag', 'user']);
}

function isRelationship($model, $field)
{
    if (isset($model->relationships()[$field])) {
        return true;
    } else {
        return false;
    }
}

function addQueryConditions($request, $query, $model, $name)
{
    //Sort
    if ($request->input('sort')) {
        $sortBy = $request->input('sort');
        if ($sortBy[0] == '-') {
            $sortDirection = "desc";
            $sortBy = ltrim($sortBy, "-");
        } else {
            $sortDirection = 'asc';
        }

        if (isRelationship($model, $sortBy)) {
            //dd(\App\Product::orderByJoin('purchases', $sortDirection, 'COUNT')->get());
            //$query = $model::orderByJoin($sortBy, $sortDirection, 'COUNT');
            //$query->orderBy($sortBy, $sortDirection);
            //$products = \App\Product::whereNotNull('name');
            //dd($products->has('purchases')->get());
            //dd($products->get());
            //dd($products->orderByJoin('purchases.id', 'asc', 'COUNT')->get());
            if ($request->input('sortMethod') != null) {
                $sortMethod = 'COUNT';
            } else {
                $sortMethod = $request->input('sortMethod');
            }

            if ($sortBy[0] == '-') {
                $sortDirection == 'asc';
            }
            $query->orderByJoin($sortBy . '.id', $sortDirection, $sortMethod);

        } else {
            $query->orderBy($sortBy, $sortDirection);
        }
    }

    //Tags
    $anyTags = $request->input('withAnyTag');
    if ($anyTags != null) {
        $anyTags = explode(',', $anyTags);
        $query->withAnyTag($anyTags);
    }

    $allTags = $request->input('withAllTags');
    if ($allTags != null) {
        $allTags = explode(',', $allTags);
        $query->withAllTags($allTags);
    }

    $withoutTags = $request->input('withoutTags');
    if ($allTags != null) {
        $withoutTags = explode(',', $withoutTags);
        $query->withAllTags($withoutTags);
    }

    //Filter
    if ($request->input('filter')) {
        $filters = $request->input('filter');
        $filters = explode(',', $filters);
        $wheres = [];
        foreach ($filters as $filter) {
            if (strpos($filter, '->') !== false) {
                $elements = explode('=', $filter);
                $operand = '=';
                if (count($elements) > 1) {
                    $wheres[] = [$elements[0], $operand, $elements[1]];
                }
            } else {
                if (strpos($filter, '!=') !== false) {
                    $elements = explode('!=', $filter);
                    $operand = '!=';
                } elseif (strpos($filter, '=') !== false) {
                    $elements = explode('=', $filter);
                    $operand = '=';
                } elseif (strpos($filter, '<') !== false) {
                    $elements = explode('<', $filter);
                    $operand = '<';
                } elseif (strpos($filter, '>') !== false) {
                    $elements = explode('>', $filter);
                    $operand = '>';
                }

                //TODO: add exception if filtered columnn doesn't excess
                //TODO: add RBAC rules for filtering
                $elements = explode($operand, $filter);
                if (Schema::hasColumn($model->getTable(), $elements[0])) {
                    $wheres[] = [$elements[0], $operand, $elements[1]];
                }
            }
        }
        $query = $query->where($wheres);
    }

    //Search
    if ($request->input('s')) {
        $search = $request->input('s');
        $count = 0;
        $options = ['model' => $model, 'search' => $search];
        $query->where(function ($query) use ($options) {
            $model = $options['model'];
            $search = $options['search'];
            foreach ($model->searchFields() as $searchField) {
                if ($count = 0) {
                    $query->where($searchField, 'ILIKE', '%' . $search . '%');
                } else {
                    $query->orWhere($searchField, 'ILIKE', '%' . $search . '%');
                }
                $count = $count + 1;
            }
        });
    }

    //Limit
    if ($request->input('limit')) {
        $limit = $request->input('limit');
        $query->limit($limit);
    }

    //Group
    //TODO: add groupBy function

    return $query;
}

function modelToPath($type)
{
    if ($type == 'post') {
        $type = 'content';
    }
    if ($type == 'analyticevent') {
        $type = 'event';
    }
    return $type;
}

function pathToModel($type)
{
    $type = strtolower($type);
    if ($type == 'content') {
        $type = 'post';
    }
    if ($type == 'event') {
        $type = 'analyticevent';
    }
    return $type;
}

function addIncludedRelationshipsToModel($request, $model)
{
    if (request()->input('include') != null) {
        $includes = explode(',', request()->input('include'));
        //If model has relationships....
        if (count($model->relationships()) > 0) {

            foreach ($includes as $include) {
                //dd(in_array('user', $item->relationships()));
                if ($model->relationships()['user'] == true) {
                    $model->relationships = [];
                    $model->relationships[$include] = $model->$include();
                }
            }
        } //If model has no relationships...
        else {
            throw new Exception('Model has no relationships.');
        }
    } else {

    }
}

function addIncludedRelationshipsToApiResource($request, $model)
{
    if (request()->input('include') != null) {
        $includes = explode(',', request()->input('include'));
        //If model has relationships....
        if (count($model->relationships()) > 0) {
            $relationships = [];

            foreach ($includes as $include) {

                //if specific fields have been requested via dot-notation, extract the included relationship and fields into separate variables
                if (strpos($include, '.') == true) {
                    $field = dotNotationToArray($include)[1];
                    $include = dotNotationToArray($include)[0];
                }
                if ($model->relationships()[$include] !== false) {
                    if (isset($field)) {

                        $collection = $model->$include()->get();

                        $subset = $collection->map(function ($item, $field) {
                            $includes = explode(',', request()->input('include'));
                            $fields = [];
                            foreach ($includes as $include) {
                                $fields[] = substr($include, strpos($include, ".") + 1);
                            }
                            return collect($item->toArray())
                                ->only($fields)
                                ->all();
                        });

                        $relationships[$include] = $subset;
                    } else {

                        $relationships[$include] = $model->$include()->get();
                    }
                }
            }
        } //If model has no relationships...
        else {
            throw new Exception('Model has no relationships.');
        }
    } else {
        $relationships = [];
    }
    return $relationships;
}

function addIncludedRelationshipsMetadataToApiResource($request, $model)
{
    if (request()->input('include') != null) {
        $includes = explode(',', request()->input('include'));
        //If model has relationships....
        if (count($model->relationships()) > 0) {
            $relationships = [];
            foreach ($includes as $include) {
                //if specific fields have been requested via dot-notation, extract the included relationship and fields into separate variables
                if (strpos($include, '.') == true) {
                    $field = dotNotationToArray($include)[1];
                    $include = dotNotationToArray($include)[0];
                }

                //dd(in_array('user', $item->relationships()));
                if ($model->relationships()['user'] == true) {
                    $class = get_class($model->$include()->getRelated());
                    $newModel = new $class;
                    $relationships[$include] = $newModel->links(['related']);
                }
            }
        }
    } else {
        $relationships = [];
    }
    return $relationships;
}

function dotNotationToArray($string)
{
    $array = explode('.', $string);
    return $array;
}

function sparseFields($array, $model)
{

    $requestedFields = request()->input('fields');
    if ($requestedFields != null && count($requestedFields) > 0) {
        $requestedFields = explode(',', $requestedFields[$model]);
        $results = [];
        foreach ($array as $item => $value) {
            if (in_array($item, $requestedFields)) {
                $results[$item] = $value;
            }
        }
        return $results;
    } else {
        return $array;
    }

}

// *********************
// Resource Editor Views
// *********************

function renderResourceTableScripts($options)
{

    $scripts = file_get_contents(resource_path() . '/views/admin/components/resourcetable.js');
    $scripts = htmlspecialchars_decode($scripts);
    if ($options['url'] != null) {
        $scripts = str_replace("XXX_RESOURCE_URL_XXX", $options['url'], $scripts);
    }
    if (isset($options['GLOBAL_FILTER'])) {
        $scripts = str_replace("XXX_GLOBAL_FILTER_XXX", $options['GLOBAL_FILTER'], $scripts);
    } else {
        $scripts = str_replace("XXX_GLOBAL_FILTER_XXX", '', $scripts);
    }
    return $scripts;

    //renderResourceTableScriptsDynamically($options);
}

function renderResourceTableScriptsDynamically($options = null)
{
    if ($options == null) {
        $options = [];
    }
    if (!isset($options['VUE_APP_NAME'])) {
        $options['VUE_APP_NAME'] = 'vueApp' . str_random(7);
    }
    if (!isset($options['div_id'])) {
        $options['div_id'] = 'contentApp';
    }
    if (!isset($options['GLOBAL_FILTER'])) {
        $options['GLOBAL_FILTER'] = '';
    }
    if (!isset($options['LIMIT'])) {
        $options['LIMIT'] = 5;
    }
    if (!isset($options['PER_PAGE'])) {
        $options['PER_PAGE'] = 10;
    }

    if (!isset($options['DISPLAY_FORMAT'])) {
        $options['DISPLAY_FORMAT'] = 'list';
    }

    if (!isset($options['SORT_BY'])) {
        $options['SORT_BY'] = 'created_at';
    }

    if (!isset($options['WITHOUT_TAGS'])) {
        $options['WITHOUT_TAGS'] = '{}';
    }

    if (!isset($options['WITH_ANY_TAGS'])) {
        $options['WITH_ANY_TAGS'] = '{}';
    }

    if (!isset($options['WITH_ALL_TAGS'])) {
        $options['WITH_ALL_TAGS'] = '{}';
    }

    $view = View::make('admin.components.resource_table_js', ['options' => $options]);
    $contents = (string)$view;
    return $contents;
}

function renderResourceTableHtml($options = null)
{
    $scripts = file_get_contents(resource_path() . '/views/admin/components/resourcetable.html');
    $scripts = htmlspecialchars_decode($scripts);
    if ($options['HEADER'] != null) {
        $scripts = str_replace("XXX_HEADER_XXX", $options['HEADER'], $scripts);
    } else {
        $scripts = str_replace("XXX_HEADER_XXX", '', $scripts);
    }
    if ($options['TABLE_HEADER'] != null) {
        $scripts = str_replace("XXX_TABLE_HEADER_XXX", $options['TABLE_HEADER'], $scripts);
    }
    if ($options['TABLE_ROW'] != null) {
        $scripts = str_replace("XXX_TABLE_ROW_XXX", $options['TABLE_ROW'], $scripts);
    }

    if ($options['PATH'] != null) {
        $scripts = str_replace("XXX_PATH_XXX", $options['PATH'], $scripts);
    }
    return $scripts;
}

function renderResourceTableHtmlDynamically($options = null)
{
    if ($options == null) {
        $options = [];
    }
    if (!isset($options['div_id'])) {
        $options['div_id'] = 'contentApp';
    }
    if (!isset($options['CARD_HEADER_FIELD'])) {
        $options['CARD_HEADER_FIELD'] = 'title';
    }
    if (!isset($options['CARD_BODY_FIELD'])) {
        $options['CARD_BODY_FIELD'] = 'excerpt';
    }

    if (!isset($options['WRAPPER_CLASS'])) {
        $options['WRAPPER_CLASS'] = 'col-md-12';
    } else {
        $options['WRAPPER_CLASS'] = ' ';
    }

    if (!isset($options['HEADER'])) {
        $options['HEADER'] = '';
    }
    if (!isset($options['SHOW_TIMESTAMP'])) {
        $options['SHOW_TIMESTAMP'] = true;
    }
    if (!isset($options['SHOW_PAGINATION'])) {
        $options['SHOW_PAGINATION'] = true;
    }
    if (!isset($options['SHOW_TAGS'])) {
        $options['SHOW_TAGS'] = true;
    }
    if (!isset($options['TABLE_ROW'])) {
        $options['TABLE_ROW'] = '';
    }
    if (!isset($options['PATH'])) {
        $options['PATH'] = '';
    }
    $view = View::make('admin.components.resource_table_html', ['options' => $options]);
    $contents = (string)$view;
    return $contents;
}

function renderResourceFilterModal($options = null)
{
    $view = View::make('admin.components.resource_filter_modal', ['options' => $options]);
    $contents = (string)$view;
    return $contents;
}

function renderResourceEditorForm($options = null, $item)
{
    $view = View::make('admin.components.resource_editor_form', ['options' => $options, 'item' => $item]);
    $contents = (string)$view;
    return $contents;
}

function renderResourceEditorScripts($options = null)
{
    $view = View::make('admin.components.resource_editor_scripts', ['options' => $options]);
    $contents = (string)$view;
    return $contents;
}

function renderFilterButton()
{
    $view = View::make('admin.components.clear_filters');
    $contents = (string)$view;
    return $contents;
}

function renderDisplayFormatButton()
{
    $view = View::make('admin.components.display_format_button');
    $contents = (string)$view;
    return $contents;
}

// Dashboard Views
function renderStatisticCard($stats, $oldStats, $statTitle, $key)
{
    $view = View::make('admin.components.statistic_card', ['stats' => $stats, 'oldStats' => $oldStats, 'statTitle' => $statTitle, 'key' => $key]);
    $contents = (string)$view;
    return $contents;
}

// ************
// JSON Schemas
// ************

function getNewSchema($type)
{
    $type = "\\App\\" . ucfirst($type);
    $model = new $type;
    return $model->schema();
}

function primaryKeyName($model)
{
    $schema = $model->schema();
    $primaryKey = $schema->metadata->primary_key;
    return $primaryKey;
}

function primaryKey($model)
{
    $schema = $model->schema();
    $primaryKey = $schema->metadata->primary_key;
    $result = $model->$primaryKey;
    return $result;
}


// ************
// Pages
// ************

function findAndFetch($fieldName, $pageField, $attribute = null)
{
    $page = \App\Page::where($fieldName, $pageField)->first();
    if ($page != null && $page->status == 'ACTIVE') {
        if ($attribute != null) {
            return $page->attribute;
        } else {
            return true;
        }
    } else {
        return false;
    }

}

function pageIsPublished($slug)
{
    $page = \App\Page::where('slug', $slug)->where('status', 'ACTIVE')->first();
    if ($page != null) {
        return true;
    } else {
        return false;
    }

}

// *************
// Message Views
// *************

function makeMessage($item)
{
    $message = [];
    if ($item->status != "PUBLISHED") {
        $message['html'] = "This item is not published.";
        if (\Auth::user()->hasPermissionTo('edit posts')) {

            $view = View::make('partials.messages.edit-content', ['item' => $item]);
            $contents = (string)$view;
            $message['html'] = $message['html'] . $contents;
        }
    }
    if (empty($message)) {
        return null;
    } else {
        return $message;
    }
}


// *************
// Message Views
// *************

function stripeKey(){
    if(ENV('APP_ENV') == 'local'){
        return(ENV('STRIPE_TEST_KEY'));
    }
    else {
        return(ENV('STRIPE_KEY'));
    }
}

function renderStripeAppJs($options = [])
{
    if(!isset($options['USER_ID'])){
        $options['USER_ID'] = \Auth::user()->id;
    }
    $view = View::make('components.stripe_app_js')->with('options', $options);
    $contents = (string)$view;
    return $contents;
}