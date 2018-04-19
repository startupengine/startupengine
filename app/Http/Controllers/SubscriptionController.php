<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = updateSubscriptionPlans();
        if ($request->input('s') !== null) {
            $subscriptions = \App\Product::where('name', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('description', 'ILIKE', '%' . $request->input('s') . '%')->limit(100)->orderBy('updated_at', 'desc')->get();
        }
        else {
            $subscriptions = \App\Product::where('status','=','ACTIVE')->get();
        }
        return view('app.subscriptions.index')->with('subscriptions', $subscriptions);
    }

    public function saveSubscription(Request $request)
    {
        $package = new Package();
        $package->url = $request->input('url');
        $package->save();
        return redirect('/app/subscriptions');
    }


    public function newSubscriptionPlan(Request $request, $id)
    {
        $product = \App\Product::where('id', '=',$id)->first();
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $plan = \Stripe\Plan::create(array(
            "interval" => "month",
            "currency" => "usd",
            "amount" => 9900,
            "product" => $product->stripe_id
        ));
        $record = new \App\Plan();
        $record->stripe_id = $plan->id;
        $record->name = $plan->nickname;
        $record->json = json_encode($plan);
        $record->save();
        return redirect("/app/view/subscription/$id/plan/$record->stripe_id");
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
