<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Models\Role;

class Roles
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
        if (Auth::guard($guard)->check()) {
            $user = \Auth::user();
            $role = Role::where('id', '=', $user->role_id)->first();
            if ($role->name == 'Administrator' OR $role->name == 'Developer' OR $role->name == 'Writer') {
                return $next($request);
            }
        }
        else { return redirect('/'); }
    }
}
