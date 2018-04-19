<?php

function setting($key)
{
    $setting = \App\Setting::where('key', '=', $key)->first();
    if($setting !== null){
        $output = $setting->value;
    }
    else {
        $output = null;
    }
    return $output;
}

function button($path, $text, $type = null, $classes = null, $iconmarkup = null, $data = null, $element = null)
{
    if($type == 'new') {
        $classes = $classes." btn btn-sm btn-round btn-secondary-outline ";
        $iconmarkup = "&nbsp; <i class=\"fa fa-sm fa-plus-square-o\"></i>";
    }
    if($type == 'edit') {
        $classes = $classes." btn btn-sm btn-round btn-secondary-outline ";
        $iconmarkup = "&nbsp; <i class=\"fa fa-sm fa-edit\"></i>";
    }
    if($type == 'save') {
        $classes = $classes . " btn btn-sm btn-round btn-success ";
        $iconmarkup = "&nbsp; <i class=\"fa fa-sm fa-check-circle-o\"></i>";
    }
        if($element == null) {
        $element = 'a';
    }

    if($path !== null) {
        $path = "href=\"$path\"";
    }

    if($element == 'button') {
        $elementMarkup = 'type="submit"';
    }
    else {
        $elementMarkup = null;
    }

    $output = "<$element $elementMarkup $path class='$classes' $data>".ucwords($text)." $iconmarkup</$element>";
    return $output;
}

function getStripeKeys(){
    if(config('app.env') == 'local'){
        $key = env('STRIPE_TEST_KEY');
        $secret = env('STRIPE_TEST_SECRET');
    }
    else {
        $key = env('STRIPE_KEY');
        $secret = env('STRIPE_SECRET');
    }
    return ["key" => $key, "secret" => $secret];
}

function updateSubscriptionProducts(){
    \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
    $products = \Stripe\Product::all();
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
    $subscriptions = \App\Product::all();
    return $subscriptions;
}

function updateSubscriptionPlans(){
    \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
    $products = \Stripe\Product::all();
    foreach(\App\Product::all() as $existing) {
        $existing->status = "INACTIVE";
        $existing->save();
    }
    foreach($products->data as $product){
        $item = \App\Product::where('stripe_id', '=', $product->id)->first();
        if($item == null){
            $item = new \App\Product();
        }
        $item->stripe_id = $product->id;
        $item->name = $product->name;
        $item->status = "ACTIVE";
        $item->json = json_encode($product);
        $item->save();
    }
    $subscriptions = \App\Product::all();
    return $subscriptions;
}


function getStripePlans($id = null){
    \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
    if($id !== null) {
        $plans = \Stripe\Plan::all(array("product" => $id));
    }
    else {
        $plans = \Stripe\Plan::all();
    }
    foreach($plans->data as $plan){
        $item = \App\Plan::where('stripe_id', '=', $id)->first();
        if($item == null){
            $item = new \App\Plan();
        }
        $item->stripe_id = $plan->id;
        $item->name = $plan->name;
        $item->json = json_encode($plan);
        $item->save();
    }
    return $plans;
}

function newStripePlan($name, $productId){
    \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
    $plan = \Stripe\Plan::create(array("product" => $productId,"name" => $name));
    dd($plan);
    return $plan;
}

function createProductPlan($request){
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
    $record->json = json_encode($plan);
    $record->save();
    return $record;
}