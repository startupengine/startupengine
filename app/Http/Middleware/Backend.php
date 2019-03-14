<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Role;

class Backend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = \Auth::user();

        //If the user is not logged in
        if ($user == null) {
            //but the path is /admin/login...
            if ($request->path() == 'admin/login') {
                //continue
                return $next($request);
            }
            //otherwise,
            else {
                //abort
                return abort('404');
            }
        }

        //If the user IS logged in
        else {
            if ($user->status !== 'ACTIVE' or $user->deleted_at !== null) {
                return abort(404);
            }

            //And they have been assigned a staff role
            if ($user->hasPermissionTo('view backend')) {
                //continue...
                return $next($request);
            }
            //Otherwise...
            else {
                //abort
                return abort('404');
            }
        }
    }
}
