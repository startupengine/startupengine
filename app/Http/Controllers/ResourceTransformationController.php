<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceTransformationController extends Controller
{
    public function add(Request $request, $type, $id)
    {
        if (isResource($type)) {
            $type = pathToModel($type);
            $name = "\\App\\$type";
            $model = new $name;
            $primaryKey = $model->getKeyName();
            $this->resourceName = "\\App\\Http\\Resources\\" . ucfirst($type);
            $result = $name::where($primaryKey, '=', $id)->first();
            $resource = collect([$result]);
            $resource->transform(function ($item, $key) {
                $transformation = app('request')->input('transformation');
                $action = app('request')->input('action');
                if ($transformation != null) {
                    if($action != null){
                        $item->$transformation($action);
                    }
                    else {
                        $item->$transformation(true);
                    }
                    $class = $this->resourceName;
                    $item = new $class($item);
                    return $item;
                } else {
                    abort(500);
                }
            });

            $jsonResponse = json_decode(json_encode($resource));

            $response = [
                'meta' => [
                    'status' => 'success',
                ],
                'links' => [
                    $result->links()
                ],
                'errors' => [],
                'data' => $jsonResponse[0]
            ];

            return response()->json($response);
        } else abort(404);
    }
}