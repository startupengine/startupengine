<?php

namespace App\Http\Middleware;

use Closure;
use Hashids\Hashids;

class PromoCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (request()->has('promo')) {
            $hashids = new Hashids();
            $id = $hashids->decode(request()->get('promo'));
            if (count($id) > 0) {
                $id = $id[0];
                $promo = \App\Promo::find($id);
                if ($promo != null) {
                    $promo->addAnalyticEvent('promo link visited');
                }
            }
        }
        return $next($request);
    }
}
