<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
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
        return view('app.products.index')->with('subscriptions', $subscriptions);
    }

}
