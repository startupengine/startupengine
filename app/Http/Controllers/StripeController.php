<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function storePaymentMethod(Request $request){
        return response()->json([1234]);
    }
}