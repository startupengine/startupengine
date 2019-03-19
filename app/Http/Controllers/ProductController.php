<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.products.index');
    }

    public function view(Request $request, $id)
    {
        $item = \App\Product::find($id);
        $options = [
            'id' => $item->id,
            'type' => 'product',
            'index_uri' => '/admin/products'
        ];

        return view('admin.components.resource_view')
            ->with('item', $item)
            ->with('options', $options);
    }

    public function viewProductPage(Request $request, $id)
    {
        $product = \App\Product::where('status', '=', 'ACTIVE')
            ->where('stripe_id', '=', $id)
            ->firstOrFail();

        $product->addAnalyticEvent('product viewed');
        return view('products.view')->with('product', $product);
    }

    public function saveProduct(Request $request)
    {
        $product = \App\Product::where(
            'id',
            '=',
            $request->input('id')
        )->first();
        if ($product == null) {
            $product = new \App\Product();
        }
        $product->name = $request->input('name');
        $product->image = $request->input('image');
        $product->description = $request->input('description');
        $product->status = $request->input('status');
        $product->priority = $request->input('priority');
        $product->save();
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $stripeproduct = \Stripe\Product::retrieve($product->stripe_id);
        $stripeproduct->name = $product->name;
        $stripeproduct->save();
        return redirect('/app/products');
    }

    public function saveProductPlan(Request $request)
    {
        $product = \App\Product::where(
            'id',
            '=',
            $request->input('id')
        )->first();
        \Stripe\Stripe::setApiKey(getStripeKeys()["secret"]);
        $stripeproduct = \Stripe\Plan::retrieve($request->plan_id);
        $plan = \App\Plan::where(
            'stripe_id',
            '=',
            $request->input("plan_id")
        )->first();
        $plan->name = $request->input('nickname');
        $plan->image = $request->input('image');
        $plan->description = $request->input('description');
        $plan->status = $request->input('status');
        $plan->save();
        $stripeproduct->nickname = $request->input("nickname");
        $stripeproduct->save();
        return redirect('/app/products');
    }
}
