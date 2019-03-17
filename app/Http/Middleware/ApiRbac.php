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
        /* dd($request->headers);
        $header = request()->header('Authorization');
        dd($header); */
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
                    request()->user() == null
                ) {
                    throw new \Exception(
                        'You must be logged in to perform this action.'
                    );
                }

                if (
                    isset($rules['requires_permission']) &&
                    \Auth::user() != null
                ) {
                    foreach ($rules['requires_permission'] as $permission) {
                        try {
                            $permission = str_replace(
                                '_',
                                ' ',
                                $rules['requires_permission']
                            );

                            if (
                                \Auth::user()->hasPermissionTo(
                                    $permission == false
                                )
                            ) {
                                abort(403);
                            }
                        } catch (\Exception $exception) {
                            // Do nothing - previously: abort(403)
                        }
                    }
                }

                if (
                    isset($rules['requires_permission']) &&
                    \Auth::user() == null
                ) {
                    abort(401, 'Permission denied.');
                }
            }
        }
        return $next($request);
    }
}
