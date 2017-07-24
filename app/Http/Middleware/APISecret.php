<?php

namespace App\Http\Middleware;

use Closure;

class APISecret
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
        if( $request->input('s') !== null && $request->input('s') == env('API_SECRET') ) {
            return $next($request);
        }
        else {
            return response()->json([
                'status' => 'failure',
                'error' => 'Incorrect API Secret'
            ]);
        }
    }
}
