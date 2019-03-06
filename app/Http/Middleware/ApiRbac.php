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
            $routeName = $request->route()->getName();
            if ($routeName == "BrowseApiResource") {
                $action = "browse";
            } elseif ($routeName == "ReadApiResource") {
                $action = "read";
            } elseif ($routeName == "AddApiResource") {
                $action = "add";
            } elseif ($routeName == "EditApiResource") {
                $action = "edit";
            } elseif ($routeName == "DeleteApiResource") {
                $action = "delete";
            }

            $type = request()->route('type');
            $type = "\\App\\" . ucwords(pathToModel($type));
            $model = new $type();

            if (
                method_exists($model, 'schema') &&
                $model->schema() != null &&
                isset($model->schema()->permissions) &&
                isset($model->schema()->permissions->$action)
            ) {
                $rules = json_decode(
                    json_encode($model->schema()->permissions),
                    true
                );
                $rules = $rules[$action];

                if (
                    isset($rules['requires_auth']) &&
                    $rules['requires_auth'] == true &&
                    \Auth::user() == null
                ) {
                    throw new \Exception(
                        'You do not have permission to perform this action.'
                    );
                }
            }
        }
        return $next($request);
    }
}
