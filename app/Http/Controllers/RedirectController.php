<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hashids\Hashids;

class RedirectController extends Controller
{
    public function redirectFromPromo($promoId)
    {
        $hashids = new Hashids();
        $id = $hashids->decode($promoId);
        if (count($id) > 0) {
            $id = $id[0];
        } else {
            abort(404);
        }

        $promo = \App\Promo::findOrFail($id);
        if (
            $promo != null &&
            $promo->getJsonContent('[sections][heading][fields][link]') != null
        ) {
            $promo->addAnalyticEvent('promo link visited');
        }
        return redirect(
            $promo->getJsonContent('[sections][heading][fields][link]')
        );
    }
}
