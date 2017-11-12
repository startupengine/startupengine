<?php

namespace App\Http\Controllers;

use App\APIResponse;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getItems(Request $request)
    {
        $items = new APIResponse();
        return $items->getItems($request);
    }

    public function getItemsByCategory(Request $request)
    {
        $items = new APIResponse();
        return $items->getItemsByCategory($request);
    }

    public function getItem(Request $request)
    {
        $items = new APIResponse();
        return $items->getItem($request);
    }

    public function getPage(Request $request, $slug)
    {
        $items = new APIResponse();
        return $items->getPage($slug);
    }

    public function getRandomPageVariation(Request $request, $slug)
    {
        $items = new APIResponse();
        return $items->getRandomPageVariation($request, $slug);
    }

    public function getRandomItem(Request $request)
    {
        $items = new APIResponse();
        return $items->getRandomItem($request);
    }

    public function search(Request $request)
    {
        $items = new APIResponse();
        return $items->search($request);
    }
}