<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Contracts\Auth\Factory as Auth;

class OptionalAuthentication extends Authenticate
{
    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards = [])
    {
        if (empty($guards)) {
            $guards = [null];
        }

        if (request()->is('api/resources/*')) {
            foreach ($guards as $guard) {
                if ($this->auth->guard($guard)->check()) {
                    return $this->auth->shouldUse($guard);
                }
            }
        } else {
            throw new AuthenticationException(
                'Unauthenticated.',
                $guards,
                $this->redirectTo($request)
            );
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $this->authenticate($guards);
        } catch (AuthenticationException $e) {
        }

        return $next($request);
    }
}
