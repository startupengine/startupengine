<?php

namespace App\Http\Middleware;

use Closure;

class ApiRbac
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
        if (request()->is('api/resources/*')) {
            $type = request()->route('type');
            $type = "\App\\" . ucwords(pathToModel($type));
            $model = new $type();
            if (
                $model->schema() != null &&
                isset($model->schema()->permissions)
            ) {
                throw new \Exception(
                    'You do not have permission to perform this action.'
                );
            }
        }
        return $next($request);
    }
}
