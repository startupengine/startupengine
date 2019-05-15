<?php

namespace App\Http\Middleware;

use Closure;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
        /*
        if (config('app.force_https') === 'TRUE') {
            if (config('app.debug') == true) {
                //dd($request->isSecure());
            }
            if ($request->isSecure()) {
                return $next($request);
            }
            if (!$request->isSecure()) {
                return redirect()->secure($request->getRequestUri());
            }

            return $next($request);
        }
        */
    }
}
