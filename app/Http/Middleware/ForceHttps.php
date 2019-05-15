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
        if (
            !$request->secure() &&
            in_array(env('APP_ENV'), ['stage', 'production'])
        ) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
