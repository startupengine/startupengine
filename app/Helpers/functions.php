<?php

use Illuminate\Support\Str;
use PHLAK\SemVer;

function get_nested_property($property, $object)
{
    return $object->$property;
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
    if (!is_array($array)) {
        return false;
    }

    // key exists
    if (array_key_exists($keySearch, $array)) {
        return true;
    }

    // key isn't in this array, go deeper
    foreach ($array as $key => $val) {
        // return true if it's found
        if (findKey($val, $keySearch)) {
            return true;
        }
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
        } elseif ($validation == "boolean" && $value == "true") {
            $newvalue = "$validation";
        } else {
            $newvalue = "$validation:$value";
        }

        if (isset($array[strtolower($field)])) {
            $array[strtolower($field)] =
                $array[strtolower($field)] . "|" . $newvalue;
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
    $strings = [$text];
    $nested_array = [];

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
    $slug = strtolower(
        trim(
            preg_replace(
                '/[\s-]+/',
                $delimiter,
                preg_replace(
                    '/[^A-Za-z0-9-]+/',
                    $delimiter,
                    preg_replace(
                        '/[&]/',
                        'and',
                        preg_replace(
                            '/[\']/',
                            '',
                            iconv('UTF-8', 'ASCII//TRANSLIT', $str)
                        )
                    )
                )
            ),
            $delimiter
        )
    );
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

function button(
    $path,
    $text,
    $type = null,
    $classes = null,
    $iconmarkup = null,
    $data = null,
    $element = null
) {
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

    $output =
        "<$element $elementMarkup $path class='$classes' $data>" .
        ucwords($text) .
        " $iconmarkup</$element>";
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
        $item = \App\Product::where('stripe_id', '=', $product->id)
            ->withTrashed()
            ->first();
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
        $plans = \Stripe\Plan::all(["product" => $id]);
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
    $plan = \Stripe\Plan::create([
        "product" => $productId,
        "name" => $name
    ]);
    return $plan;
}

function createProductPlan($request)
{
    \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
    $plan = \Stripe\Plan::create([
        "interval" => $request->input('interval'),
        "currency" => "usd",
        "amount" => $request->input('amount'),
        "product" => $request->input('product_id')
    ]);
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
        $posts = \App\Post::where('post_type', '=', $postType)
            ->where('status', '=', 'PUBLISHED')
            ->get();
    } else {
        $posts = \App\Post::where('post_type', '=', $postType)
            ->where('status', '=', 'PUBLISHED')
            ->limit($limit)
            ->get();
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
    return in_array($string, [
        'event',
        'content',
        'feature',
        'log',
        'package',
        'page',
        'payment',
        'permission',
        'plan',
        'preference',
        'preferenceschema',
        'product',
        'role',
        'setting',
        'settingsgroup',
        'subscription',
        'tag',
        'user',
        'userpreference'
    ]);
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
                } elseif (strpos($filter, '>=') !== false) {
                    $elements = explode('>=', $filter);
                    $operand = '>=';
                } elseif (strpos($filter, '<=') !== false) {
                    $elements = explode('<=', $filter);
                    $operand = '<=';
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
                if (($count = 0)) {
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
                            $includes = explode(
                                ',',
                                request()->input('include')
                            );
                            $fields = [];
                            foreach ($includes as $include) {
                                $fields[] = substr(
                                    $include,
                                    strpos($include, ".") + 1
                                );
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
                    $newModel = new $class();
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
    $scripts = file_get_contents(
        resource_path() . '/views/admin/components/resourcetable.js'
    );
    $scripts = htmlspecialchars_decode($scripts);
    if ($options['url'] != null) {
        $scripts = str_replace(
            "XXX_RESOURCE_URL_XXX",
            $options['url'],
            $scripts
        );
    }
    if (isset($options['GLOBAL_FILTER'])) {
        $scripts = str_replace(
            "XXX_GLOBAL_FILTER_XXX",
            $options['GLOBAL_FILTER'],
            $scripts
        );
    } else {
        $scripts = str_replace("XXX_GLOBAL_FILTER_XXX", '', $scripts);
    }
    return $scripts;

    //renderResourceTableScriptsDynamically($options);
}

function renderResourceTableScriptsDynamically($options = null)
{
    if (!isset($options)) {
        $options = [];
    }
    if (!isset($options['VUE_APP_NAME'])) {
        $options['VUE_APP_NAME'] = 'vueApp' . Str::random(7);
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

    if ($options['PER_PAGE'] > $options['LIMIT']) {
        $options['PER_PAGE'] = $options['LIMIT'];
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

    $view = View::make('admin.components.resource_table_js', [
        'options' => $options
    ]);

    $contents = (string) $view;

    return $contents;
}

function renderResourceTableHtml($options = null)
{
    $scripts = file_get_contents(
        resource_path() . '/views/admin/components/resourcetable.html'
    );
    $scripts = htmlspecialchars_decode($scripts);
    if ($options['HEADER'] != null) {
        $scripts = str_replace("XXX_HEADER_XXX", $options['HEADER'], $scripts);
    } else {
        $scripts = str_replace("XXX_HEADER_XXX", '', $scripts);
    }
    if ($options['TABLE_HEADER'] != null) {
        $scripts = str_replace(
            "XXX_TABLE_HEADER_XXX",
            $options['TABLE_HEADER'],
            $scripts
        );
    }
    if ($options['TABLE_ROW'] != null) {
        $scripts = str_replace(
            "XXX_TABLE_ROW_XXX",
            $options['TABLE_ROW'],
            $scripts
        );
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
    $view = View::make('admin.components.resource_table_html', [
        'options' => $options
    ]);
    $contents = (string) $view;
    return $contents;
}

function renderNewItemModal($options = null)
{
    $view = View::make('components.new_item_modal', ['options' => $options]);
    $contents = (string) $view;
    return $contents;
}

function renderNewItemScripts($options = null)
{
    $view = View::make('components.new_item_scripts', ['options' => $options]);
    $contents = (string) $view;
    return $contents;
}

function renderNewUserScripts($options = null)
{
    $view = View::make('components.new_user_scripts', ['options' => $options]);
    $contents = (string) $view;
    return $contents;
}

function renderResourceFilterModal($options = null)
{
    $view = View::make('admin.components.resource_filter_modal', [
        'options' => $options
    ]);
    $contents = (string) $view;
    return $contents;
}

function renderResourceEditorForm($options = null, $item)
{
    $view = View::make('admin.components.resource_editor_form', [
        'options' => $options,
        'item' => $item
    ]);
    //dd($view);
    $contents = (string) $view;
    return $contents;
}

function renderResourceEditorScripts($options = null)
{
    $view = View::make('admin.components.resource_editor_scripts', [
        'options' => $options
    ]);
    $contents = (string) $view;
    return $contents;
}

function renderConfirmActionModal($options = null)
{
    $view = View::make('components.confirm_action_modal', [
        'options' => $options
    ]);
    $contents = (string) $view;
    return $contents;
}

function renderConfirmActionScripts($options = null)
{
    $view = View::make('components.confirm_action_scripts', [
        'options' => $options
    ]);
    $contents = (string) $view;
    return $contents;
}

function renderFilterButton()
{
    $view = View::make('admin.components.clear_filters');
    $contents = (string) $view;
    return $contents;
}

function renderDisplayFormatButton()
{
    $view = View::make('admin.components.display_format_button');
    $contents = (string) $view;
    return $contents;
}

// Dashboard Views
function renderStatisticCard($stats, $oldStats, $statTitle, $key)
{
    $view = View::make('admin.components.statistic_card', [
        'stats' => $stats,
        'oldStats' => $oldStats,
        'statTitle' => $statTitle,
        'key' => $key
    ]);
    $contents = (string) $view;
    return $contents;
}

// ************
// JSON Schemas
// ************

function getNewSchema($type)
{
    $type = "\\App\\" . ucfirst($type);
    $model = new $type();
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
    $page = \App\Page::where('slug', $slug)
        ->where('status', 'ACTIVE')
        ->first();
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
            $view = View::make('partials.messages.edit-content', [
                'item' => $item
            ]);
            $contents = (string) $view;
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

function stripeKey($type = null)
{
    if (ENV('APP_ENV') != 'production') {
        if ($type == 'secret') {
            return ENV('STRIPE_TEST_SECRET');
        } else {
            return ENV('STRIPE_TEST_KEY');
        }
    } else {
        if ($type == 'secret') {
            return ENV('STRIPE_SECRET');
        } else {
            return ENV('STRIPE_KEY');
        }
    }
}

function renderStripeAppJs($options = [])
{
    if (!isset($options['USER_ID'])) {
        $options['USER_ID'] = \Auth::user()->id;
    }
    $view = View::make('components.stripe_app_js')->with('options', $options);
    $contents = (string) $view;
    return $contents;
}

// ********
// Passport
// ********

function renderPassportApp()
{
    $view = View::make('components.passport_app');
    $contents = (string) $view;
    return $contents;
}

function passportAuthorizationHeader()
{
    if (\Auth::user()) {
        return "Bearer " . \Auth::user()->webAppToken();
    } else {
        return "Bearer ";
    }
}

// **********
// Currencies
// **********

function convertCurrency($amount, $currency, $newCurrency = "USD")
{
    setlocale(LC_MONETARY, 'en_US');
    $result = money_format('%n', $amount);
    return $result;
}

function formatcurrency($floatcurr, $curr = "USD")
{
    $currencies['ARS'] = [2, ',', '.']; //  Argentine Peso
    $currencies['AMD'] = [2, '.', ',']; //  Armenian Dram
    $currencies['AWG'] = [2, '.', ',']; //  Aruban Guilder
    $currencies['AUD'] = [2, '.', ' ']; //  Australian Dollar
    $currencies['BSD'] = [2, '.', ',']; //  Bahamian Dollar
    $currencies['BHD'] = [3, '.', ',']; //  Bahraini Dinar
    $currencies['BDT'] = [2, '.', ',']; //  Bangladesh, Taka
    $currencies['BZD'] = [2, '.', ',']; //  Belize Dollar
    $currencies['BMD'] = [2, '.', ',']; //  Bermudian Dollar
    $currencies['BOB'] = [2, '.', ',']; //  Bolivia, Boliviano
    $currencies['BAM'] = [2, '.', ',']; //  Bosnia and Herzegovina, Convertible Marks
    $currencies['BWP'] = [2, '.', ',']; //  Botswana, Pula
    $currencies['BRL'] = [2, ',', '.']; //  Brazilian Real
    $currencies['BND'] = [2, '.', ',']; //  Brunei Dollar
    $currencies['CAD'] = [2, '.', ',']; //  Canadian Dollar
    $currencies['KYD'] = [2, '.', ',']; //  Cayman Islands Dollar
    $currencies['CLP'] = [0, '', '.']; //  Chilean Peso
    $currencies['CNY'] = [2, '.', ',']; //  China Yuan Renminbi
    $currencies['COP'] = [2, ',', '.']; //  Colombian Peso
    $currencies['CRC'] = [2, ',', '.']; //  Costa Rican Colon
    $currencies['HRK'] = [2, ',', '.']; //  Croatian Kuna
    $currencies['CUC'] = [2, '.', ',']; //  Cuban Convertible Peso
    $currencies['CUP'] = [2, '.', ',']; //  Cuban Peso
    $currencies['CYP'] = [2, '.', ',']; //  Cyprus Pound
    $currencies['CZK'] = [2, '.', ',']; //  Czech Koruna
    $currencies['DKK'] = [2, ',', '.']; //  Danish Krone
    $currencies['DOP'] = [2, '.', ',']; //  Dominican Peso
    $currencies['XCD'] = [2, '.', ',']; //  East Caribbean Dollar
    $currencies['EGP'] = [2, '.', ',']; //  Egyptian Pound
    $currencies['SVC'] = [2, '.', ',']; //  El Salvador Colon
    $currencies['ATS'] = [2, ',', '.']; //  Euro
    $currencies['BEF'] = [2, ',', '.']; //  Euro
    $currencies['DEM'] = [2, ',', '.']; //  Euro
    $currencies['EEK'] = [2, ',', '.']; //  Euro
    $currencies['ESP'] = [2, ',', '.']; //  Euro
    $currencies['EUR'] = [2, ',', '.']; //  Euro
    $currencies['FIM'] = [2, ',', '.']; //  Euro
    $currencies['FRF'] = [2, ',', '.']; //  Euro
    $currencies['GRD'] = [2, ',', '.']; //  Euro
    $currencies['IEP'] = [2, ',', '.']; //  Euro
    $currencies['ITL'] = [2, ',', '.']; //  Euro
    $currencies['LUF'] = [2, ',', '.']; //  Euro
    $currencies['NLG'] = [2, ',', '.']; //  Euro
    $currencies['PTE'] = [2, ',', '.']; //  Euro
    $currencies['GHC'] = [2, '.', ',']; //  Ghana, Cedi
    $currencies['GIP'] = [2, '.', ',']; //  Gibraltar Pound
    $currencies['GTQ'] = [2, '.', ',']; //  Guatemala, Quetzal
    $currencies['HNL'] = [2, '.', ',']; //  Honduras, Lempira
    $currencies['HKD'] = [2, '.', ',']; //  Hong Kong Dollar
    $currencies['HUF'] = [0, '', '.']; //  Hungary, Forint
    $currencies['ISK'] = [0, '', '.']; //  Iceland Krona
    $currencies['INR'] = [2, '.', ',']; //  Indian Rupee
    $currencies['IDR'] = [2, ',', '.']; //  Indonesia, Rupiah
    $currencies['IRR'] = [2, '.', ',']; //  Iranian Rial
    $currencies['JMD'] = [2, '.', ',']; //  Jamaican Dollar
    $currencies['JPY'] = [0, '', ',']; //  Japan, Yen
    $currencies['JOD'] = [3, '.', ',']; //  Jordanian Dinar
    $currencies['KES'] = [2, '.', ',']; //  Kenyan Shilling
    $currencies['KWD'] = [3, '.', ',']; //  Kuwaiti Dinar
    $currencies['LVL'] = [2, '.', ',']; //  Latvian Lats
    $currencies['LBP'] = [0, '', ' ']; //  Lebanese Pound
    $currencies['LTL'] = [2, ',', ' ']; //  Lithuanian Litas
    $currencies['MKD'] = [2, '.', ',']; //  Macedonia, Denar
    $currencies['MYR'] = [2, '.', ',']; //  Malaysian Ringgit
    $currencies['MTL'] = [2, '.', ',']; //  Maltese Lira
    $currencies['MUR'] = [0, '', ',']; //  Mauritius Rupee
    $currencies['MXN'] = [2, '.', ',']; //  Mexican Peso
    $currencies['MZM'] = [2, ',', '.']; //  Mozambique Metical
    $currencies['NPR'] = [2, '.', ',']; //  Nepalese Rupee
    $currencies['ANG'] = [2, '.', ',']; //  Netherlands Antillian Guilder
    $currencies['ILS'] = [2, '.', ',']; //  New Israeli Shekel
    $currencies['TRY'] = [2, '.', ',']; //  New Turkish Lira
    $currencies['NZD'] = [2, '.', ',']; //  New Zealand Dollar
    $currencies['NOK'] = [2, ',', '.']; //  Norwegian Krone
    $currencies['PKR'] = [2, '.', ',']; //  Pakistan Rupee
    $currencies['PEN'] = [2, '.', ',']; //  Peru, Nuevo Sol
    $currencies['UYU'] = [2, ',', '.']; //  Peso Uruguayo
    $currencies['PHP'] = [2, '.', ',']; //  Philippine Peso
    $currencies['PLN'] = [2, '.', ' ']; //  Poland, Zloty
    $currencies['GBP'] = [2, '.', ',']; //  Pound Sterling
    $currencies['OMR'] = [3, '.', ',']; //  Rial Omani
    $currencies['RON'] = [2, ',', '.']; //  Romania, New Leu
    $currencies['ROL'] = [2, ',', '.']; //  Romania, Old Leu
    $currencies['RUB'] = [2, ',', '.']; //  Russian Ruble
    $currencies['SAR'] = [2, '.', ',']; //  Saudi Riyal
    $currencies['SGD'] = [2, '.', ',']; //  Singapore Dollar
    $currencies['SKK'] = [2, ',', ' ']; //  Slovak Koruna
    $currencies['SIT'] = [2, ',', '.']; //  Slovenia, Tolar
    $currencies['ZAR'] = [2, '.', ' ']; //  South Africa, Rand
    $currencies['KRW'] = [0, '', ',']; //  South Korea, Won
    $currencies['SZL'] = [2, '.', ', ']; //  Swaziland, Lilangeni
    $currencies['SEK'] = [2, ',', '.']; //  Swedish Krona
    $currencies['CHF'] = [2, '.', '\'']; //  Swiss Franc
    $currencies['TZS'] = [2, '.', ',']; //  Tanzanian Shilling
    $currencies['THB'] = [2, '.', ',']; //  Thailand, Baht
    $currencies['TOP'] = [2, '.', ',']; //  Tonga, Paanga
    $currencies['AED'] = [2, '.', ',']; //  UAE Dirham
    $currencies['UAH'] = [2, ',', ' ']; //  Ukraine, Hryvnia
    $currencies['USD'] = [2, '.', ',']; //  US Dollar
    $currencies['VUV'] = [0, '', ',']; //  Vanuatu, Vatu
    $currencies['VEF'] = [2, ',', '.']; //  Venezuela Bolivares Fuertes
    $currencies['VEB'] = [2, ',', '.']; //  Venezuela, Bolivar
    $currencies['VND'] = [0, '', '.']; //  Viet Nam, Dong
    $currencies['ZWD'] = [2, '.', ' ']; //  Zimbabwe Dollar

    function formatinr($input)
    {
        //CUSTOM FUNCTION TO GENERATE ##,##,###.##
        $dec = "";
        $pos = strpos($input, ".");
        if ($pos === false) {
            //no decimals
        } else {
            //decimals
            $dec = substr(round(substr($input, $pos), 2), 1);
            $input = substr($input, 0, $pos);
        }
        $num = substr($input, -3); //get the last 3 digits
        $input = substr($input, 0, -3); //omit the last 3 digits already stored in $num
        while (strlen($input) > 0 //loop the process - further get digits 2 by 2
        ) {
            $num = substr($input, -2) . "," . $num;
            $input = substr($input, 0, -2);
        }
        return $num . $dec;
    }

    if ($curr == "INR") {
        return formatinr($floatcurr);
    } else {
        return number_format(
            $floatcurr,
            $currencies[$curr][0],
            $currencies[$curr][1],
            $currencies[$curr][2]
        );
    }
}

// ***************
// Error Reporting
// ***************

function jsonErrorMessage($input = null)
{
    $response = [];
    if ($input != null && gettype($input) == 'array') {
        if (isset($input['status'])) {
            $response['status'] = $input['status'];
        }
        if (isset($input['code'])) {
            $response['code'] = $input['code'];
        }
        if (isset($input['title'])) {
            $response['title'] = $input['title'];
        }
        if (isset($input['detail'])) {
            $response['detail'] = $input['detail'];
        }
        if (isset($input['message'])) {
            $response['message'] = $input['message'];
        }
    } else {
        $response['status'] = 500;
        $response['code'] = null;
        $response['title'] = null;
        $response['detail'] = null;
        $response['message'] = null;
    }
    if (!isset($response['status'])) {
        $response['status'] = 500;
    }
    if ($response['message'] == null) {
        if ($input != null && gettype($input) == 'string') {
            $message = $input;
        } else {
            $message = 'Something went wrong.';
        }
        $response['message'] = $message;
    }
    return ['errors' => $response];
}

function renderNotificationsApp()
{
    $view = View::make('components.notifications_app');
    $contents = (string) $view;
    return $contents;
}

function renderFormInputs($options = null)
{
    if (!isset($options)) {
        $options = [];
    }
    if (!isset($options['fieldName'])) {
        $options['fieldName'] = 'item';
    }
    if (!isset($options['storageObject'])) {
        $options['storageObject'] = 'newItemInput';
    }
    if (isset($options['jsonFields']) && $options['jsonFields'] == true) {
        if (!isset($options['storageObjectFieldKey'])) {
            $options['storageObjectFieldKey'] =
                "'json.sections.'+ index + '.fields.' + fieldIndex";
        }
        if (!isset($options['v-model'])) {
            $options['v-model'] =
                "newItemInput['json.sections.'+ index + '.fields.' + fieldIndex]";
        }
        if (!isset($options['fieldName'])) {
            $options['fieldName'] = 'field';
        }
    } else {
        if (!isset($options['storageObjectFieldKey'])) {
            $options['storageObjectFieldKey'] = 'index';
        }
        if (!isset($options['v-model'])) {
            $options['v-model'] = 'newItemInput[index]';
        }
    }
    if (!isset($options['fieldType'])) {
        $options['fieldType'] = 'item.type';
    }
    if (!isset($options['fieldDescription'])) {
        $options['fieldDescription'] = 'item.description';
    }
    $view = View::make('components.inputs', ['options' => $options]);
    $contents = (string) $view;
    return $contents;
}

function hasAttribute($attr)
{
    return array_key_exists($attr, $this->attributes);
}

function appVersion($options = [])
{
    if (isset($options['version'])) {
        $version = new SemVer\Version($options['version']);
    } elseif (file_exists(base_path('storage/app/version.json'))) {
        $oldVersion = json_decode(
            file_get_contents(base_path('storage/app/version.json'))
        );
        $options['version'] = $oldVersion->version;
        $version = new SemVer\Version($options['version']);
    } else {
        $version = new SemVer\Version(); // Initilializes to '0.1.0'
    }

    if (isset($options['increment']) && $options['increment'] == 'major') {
        $version->incrementMajor(); // v1.2.3 -> v2.0.0
    }
    if (isset($options['increment']) && $options['increment'] == 'minor') {
        $version->incrementMinor(); // v1.2.3 -> v1.3.0
    }
    if (isset($options['increment']) && $options['increment'] == 'patch') {
        $version->incrementPatch(); // v1.2.3 -> v1.2.4
    }

    if (isset($options['save']) && $options['save'] == true) {
        $newJsonString = json_encode(
            ["version" => (string) $version],
            JSON_PRETTY_PRINT
        );
        file_put_contents(
            base_path('storage/app/version.json'),
            stripslashes($newJsonString)
        );
    }
    return $version;
}

function docFiles($folder)
{
    $array = scandir(base_path('storage/docs/content/' . $folder));
    $results = [];
    foreach ($array as $result) {
        if (strpos($result, 'description.md') !== true &&
            strpos($result, '.md') !== false
        ) {
            $results[] = $result;
        }
    }

    return $results;
}

function docsPath()
{
    return base_path('storage/docs/content/');
}

function docsTitle($folder, $file)
{
    $input = file_get_contents(docsPath() . $folder . '/' . $file);
    $input = \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($input);

    $headings = strtok($input, "\n");

    if ($headings != null) {
        $title = $headings;
    } else {
        $title = $input;
    }
    return strip_tags($title);
}

function hasDocs()
{
    $basepath = base_path('storage/docs/content/');
    $array = scandir($basepath);
    $results = [];
    foreach ($array as $path) {
        if ($path !== '.' &&
            $path !== '..' &&
            strtolower($path) !== '.ds_store' &&
            is_dir($basepath . $path)
        ) {
            $results[] = $path;
        }
    }
    $folderCount = count($results);

    $path = $basepath;
    $array = scandir($path);
    $results = [];
    foreach ($array as $path) {
        if (strpos($path, '.md') !== false && $path != 'description.md') {
            $results[] = $path;
        }
    }
    $rootdocs = count($results);
    if ($rootdocs > 0 or $folderCount > 0) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function docsFolders($root = null)
{
    $basepath = base_path('storage/docs/content/' . $root . '/');
    $array = scandir($basepath);
    $results = [];
    foreach ($array as $path) {
        if ($path !== '.' &&
            $path !== '..' &&
            strtolower($path) !== '.ds_store' &&
            is_dir($basepath . $path)
        ) {
            $results[] = $path;
        }
    }
    return $results;
}

function firstDoc($folder = null, $subfolder = null)
{
    $path = base_path('storage/docs/content/' . $folder);
    if ($subfolder != null) {
        $path = $path . "/" . $subfolder;
    }
    $array = scandir($path);
    $results = [];
    foreach ($array as $path) {
        if (strpos($path, '.md') !== false && $path != 'description.md') {
            $results[] = $path;
        }
    }
    return $results[0];
}

function nextDoc($folder = null, $current = null)
{
    $array = scandir(base_path('storage/docs/content/' . $folder));
    $results = [];
    foreach ($array as $path) {
        if (strpos($path, '.md') !== false) {
            $results[] = $path;
        }
    }
    $position = array_search($current, $results);
    $total = count($results);
    if ($total > $position + 1) {
        $hasNext = true;
    } else {
        $hasNext = false;
    }
    if ($hasNext == true) {
        $nextFile = $results[$position + 1];
        if (file_exists(docsPath() . '/' . $folder . '/' . $nextFile)) {
            $nextPreview = file_get_contents(
                docsPath() . '/' . $folder . '/' . $nextFile
            );
        }
    } else {
        $nextFile = null;
        $nextPreview = null;
    }

    if ($nextFile == 'description.md') {
        $hasNext = false;
        $nextFile = null;
        $nextPreview = null;
    }

    return [
        "position" => $position,
        "total" => $total,
        "array" => $results,
        "has_next" => $hasNext,
        "next_file" => $nextFile,
        "next_preview" => str_replace("# ", "", strtok($nextPreview, "\n"))
    ];
}

function prevDoc($folder = null, $current = null)
{
    $array = scandir(base_path('storage/docs/content/' . $folder));
    $results = [];
    foreach ($array as $path) {
        if (strpos($path, '.md') !== false) {
            $results[] = $path;
        }
    }
    $position = array_search($current, $results);
    $total = count($results);
    if ($position > 0) {
        $hasPrev = true;
    } else {
        $hasPrev = false;
    }
    if ($hasPrev == true) {
        $prevFile = $results[$position - 1];
        if (file_exists(docsPath() . '/' . $folder . '/' . $prevFile)) {
            $prevPreview = file_get_contents(
                docsPath() . '/' . $folder . '/' . $prevFile
            );
        }
    } else {
        $prevFile = null;
        $prevPreview = null;
    }

    if ($prevFile == 'description.md') {
        $hasPrev = false;
        $prevFile = null;
        $prevPreview = null;
    }

    $results = [
        "position" => $position,
        "total" => $total,
        "array" => $results,
        "has_prev" => $hasPrev,
        "prev_file" => $prevFile,
        "prev_preview" => str_replace("# ", "", strtok($prevPreview, "\n"))
    ];

    return $results;
}

// *************
// Landing Pages
// *************

function hasLandingPage($folder = 'home')
{
    $path = resource_path('views/pages/defaults/');
    $path = $path . $folder . '/' . $folder . '.blade.php';
    $exists = file_exists($path);
    return $exists;
}

function defaultPage($folder = 'home')
{
    $path = 'pages.defaults.';
    $path = $path . $folder . '.' . $folder;
    return $path;
}

// *************
// Introspection
// *************

function sellsSaas()
{
    $saas = \App\Product::where('status', '=', 'ACTIVE')->get();
    return $saas;
}

function defaultPageExists($slug)
{
    if (view()->exists('pages.defaults.' . $slug . '.index')) {
        return true;
    } else {
        return false;
    }
}

function hasSubscriptionProductsForSale()
{
    $products = \App\Product::where('status', 'ACTIVE')
        ->where(
            'json->sections->about->fields->type',
            '=',
            'Software Subscription'
        )
        ->Orwhere(
            'json->sections->about->fields->type',
            '=',
            'Content Subscription'
        )
        ->where('status', '=', 'ACTIVE')
        ->get();

    if (count($products) < 1) {
        return false;
    } else {
        return true;
    }
}

function getSubscriptionProducts()
{
    $products = \App\Product::where('status', 'ACTIVE')
        ->where(
            'json->sections->about->fields->type',
            '=',
            'Software Subscription'
        )
        ->Orwhere(
            'json->sections->about->fields->type',
            '=',
            'Content Subscription'
        )
        ->where('status', '=', 'ACTIVE')
        ->get();

    return $products;
}
