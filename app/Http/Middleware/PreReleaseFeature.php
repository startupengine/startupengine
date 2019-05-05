<?php

namespace App\Http\Middleware;

use Closure;

class PreReleaseFeature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $feature)
    {
        if (!isActiveFeature($feature)) {
            abort(404);
        }

        return $next($request);
    }
}
