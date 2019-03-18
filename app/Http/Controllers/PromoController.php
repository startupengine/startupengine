<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hashids\Hashids;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.promos.index');
    }

    public function view(Request $request, $id)
    {
        $item = \App\Promo::find($id);
        $options = [
            'id' => $item->id,
            'type' => 'promo',
            'index_uri' => '/admin/promos'
        ];

        return view('admin.components.resource_view')
            ->with('item', $item)
            ->with('options', $options);
    }

    public function getItem($hash)
    {
        $hashids = new Hashids();
        $id = $hashids->decode($hash);
        if (count($id) == 0) {
            abort(404);
        }
        $id = $id[0];

        $item = \App\Promo::findOrFail($id);
        $options = [
            'id' => $item->id,
            'type' => 'promo',
            'index_uri' => '/admin/promos'
        ];

        return view('promos.view')->with('promo', $item);
    }
}
