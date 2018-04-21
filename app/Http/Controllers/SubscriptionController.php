<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = updateSubscriptionPlans();
        if ($request->input('s') !== null) {
            $subscriptions = \App\Subscription::where('name', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('description', 'ILIKE', '%' . $request->input('s') . '%')->limit(100)->orderBy('updated_at', 'desc')->get();
        }
        else {
            $subscriptions = \App\Subscription::all();
        }
        return view('app.subscriptions.index')->with('subscriptions', $subscriptions);
    }

    public function saveSubscription(Request $request)
    {
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $product = \Stripe\Product::create(array(
            "name" => $request->input('name'),
            "type" => "service",
            "description" => null,
            "attributes" => []
        ));
        $record = new \App\Product();
        $record->stripe_id = $product->id;
        $record->name = $request->input("name");
        $record->json = json_encode($product);
        $record->save();
        return redirect("/app/view/subscription/$record->id");
    }

    public function confirmSubscription($id){
        $plan = \App\Plan::where('stripe_id', '=', $id)->first();
        if($plan !== null && $plan->json()->trial_period_days > 0) {
            return redirect ("/subscribe?id=$plan->stripe_id");
        }
        else {
            return redirect ("/pricing");
        }
    }

    public function submitSubscription(Request $request)
    {
        dd($request->input());
        $productId = $request->input('product_id');
        $product = \App\Product::where('id', '=',$productId)->first();
        if($request->input('amount') == null){
            $amount = 0;
        }
        else {
            $amount = $request->input('amount')*100;
        }
        if($request->input('interval') == null){
            $interval = "month";
        }
        else {
            $interval  = $request->input('interval');
        }
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $plan = \Stripe\Plan::create(array(
            "interval" => $interval,
            "currency" => "usd",
            "amount" => $amount,
            "product" => $product->stripe_id,
            "nickname" => $request->input("nickname")
        ));
        $record = new \App\Plan();
        $record->stripe_id = $plan->id;
        $record->name = $plan->nickname;
        $record->json = json_encode($plan);
        $record->save();
        return redirect("/app/view/subscription/$product->id/plan/$record->stripe_id");
    }

    public function newSubscriptionPlan(Request $request)
    {
        $productId = $request->input('product_id');
        $product = \App\Product::where('id', '=',$productId)->first();
        if($request->input('amount') == null){
            $amount = 0;
        }
        else {
            $amount = $request->input('amount')*100;
        }
        if($request->input('interval') == null){
            $interval = "month";
        }
        else {
            $interval  = $request->input('interval');
        }
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $plan = \Stripe\Plan::create(array(
            "interval" => $interval,
            "currency" => "usd",
            "amount" => $amount,
            "product" => $product->stripe_id,
            "nickname" => $request->input("nickname")
        ));
        $record = new \App\Plan();
        $record->stripe_id = $plan->id;
        $record->name = $plan->nickname;
        $record->json = json_encode($plan);
        $record->save();
        return redirect("/app/view/subscription/$product->id/plan/$record->stripe_id");
    }

    public function viewSubscription(Request $request, $id)
    {
        $product = \App\Product::where('id', '=',$id)->first();
        return view('app.subscriptions.edit')->with('product', $product);
    }

    public function viewSubscriptionPlan(Request $request, $id, $plan)
    {
        $product = \App\Product::where('id', '=',$id)->first();
        $plan = \App\Plan::where('stripe_id', '=', $plan)->first();
        return view('app.subscriptions.plan')->with('product', $product)->with('plan', $plan);
    }

    public function deleteSubscription(Request $request, $id)
    {
        $package = Package::where('id', '=', $id)->first();
        $package->delete();
        return redirect('/app/subscriptions');
    }
}
