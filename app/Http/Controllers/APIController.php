<?php

namespace App\Http\Controllers;

use App\APIResponse;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getItems(Request $request){
        $items = new APIResponse();
        return $items->getItems($request);
    }
    public function getItemsByCategory(Request $request){
        $items = new APIResponse();
        return $items->getItemsByCategory($request);
    }
    public function getItem(Request $request){
        $items = new APIResponse();
        return $items->getItem($request);
    }
    public function search(Request $request){
        $items = new APIResponse();
        return $items->search($request);
    }
}