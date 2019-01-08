<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnalyticEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ResourceController extends Controller
{

    public function browse(Request $request, $type)
    {
        if (isResource($type)) {
            $type = ucwords(pathToModel($type));
            $name = "\\App\\$type";

            $model = new $name;

            $this->resourceName = "\\App\\Http\\Resources\\" . ucfirst($type);
            $query = $name::query();

            $resource = addQueryConditions($request, $query, $model, $name);

            $count = (count($query->get()));
            $perPage = $request->input('perPage');
            $resource = $resource->jsonPaginate($perPage);

            $total = $count;

            $resource->transform(function ($item) {
                if (gettype($item->json) == 'string') {
                    $item->json = json_decode($item->json);
                }
                if ($item->remote_data != null) {
                    $item->remote_data = json_decode($item->remote_data);
                }
                $class = $this->resourceName;
                $item = new $class($item);
                return $item;
            });


            $jsonResponse = json_decode(json_encode($resource));

            $response = [
                'meta' => [
                    'status' => 'success',
                    'pages' => ceil($total / $jsonResponse->per_page),
                    'total' => $total,
                    'from' => $jsonResponse->from,
                    'to' => $jsonResponse->to,
                    'per_page' => $jsonResponse->per_page,
                    'path' => $jsonResponse->path,
                    'current_page' => $jsonResponse->current_page
                ],
                'links' => [
                    'first_page_url' => $jsonResponse->first_page_url,
                    'next_page_url' => $jsonResponse->next_page_url,
                    'prev_page_url' => $jsonResponse->prev_page_url,
                    'last_page_url' => $jsonResponse->last_page_url
                ],
                'errors' => [],
                'data' => $jsonResponse->data
            ];

            if (count(addIncludedRelationshipsMetadataToApiResource(request(), $model)) > 0) {
                $response['include'] = addIncludedRelationshipsMetadataToApiResource(request(), $model);
            }
            //dd($jsonResponse->data->groupBy('created_at'));
            return response()->json($response);
        } else abort(404);
    }

    public function read(Request $request, $type, $id)
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
                if (gettype($item->json) == 'string') {
                    $item->json = json_decode($item->json);
                }
                if ($item->remote_data != null) {
                    $item->remote_data = json_decode($item->remote_data);
                }
                $class = $this->resourceName;
                $item = new $class($item);
                return $item;
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

    public function add(Request $request, $type)
    {
        if (isResource($type)) {
            $type = pathToModel($type);
            $name = "\\App\\$type";
            $model = new $name;
            //$model->json = [];
            $model->schema = $model->schema();

            $jsonInput = $request->input('data');
            $schema = $model->schema();


            $newArray = [];
            $errors = [];
            $item = $model;

            $requiredFields = [];
            foreach($schema->fields as $key => $schemaField){
                if(isset($schemaField->validations->required)){
                    $requiredFields[$key] = $model->$key;
                }
            }
            $jsonInput = array_merge($requiredFields, $jsonInput);
            if(isset($schema->sections)){
                $requiredJsonFields = [];
                foreach($schema->sections as $key => $sectionContents){

                    foreach($sectionContents->fields as $virtualField => $fieldContents) {
                        if (isset($fieldContents->validations->required)) {
                            $requiredJsonFields['json.sections.'.$key.'.'.$virtualField] = null;
                        }
                    }
                }

                $jsonInput = array_merge($jsonInput,$requiredJsonFields);
            }

            //if JSON has input data...
            if (isset($jsonInput)) {


                //foreach field
                foreach ($jsonInput as $field => $value) {

                    $schema = json_decode(json_encode($schema), true);

                    if (strpos($field, '.') !== false) {
                        $field = explode('json.', $field);
                        $field = $field[1];
                        //dd($field);
                        $arrayIndexes = explode(".", $field);


                        $schemaFieldDefinition = (get_array_value($schema, $arrayIndexes));

                    } else {
                        if (isset($schema['fields'][$field])) {
                            $schemaFieldDefinition = $schema['fields'][$field];
                        } else {
                            $response["status"] = "error";
                            $response["message"] = "Invalid input: cannot write field '" . $field . "'";
                            $response["fields"] = [$field => ["errors" => "Cannot write field $field"]];
                            $response['data'] = null;
                            return $response;
                        }
                    }






                    if ($schemaFieldDefinition == false) {
                        $schemaFieldDefinition = [];
                    }

                    $hasvalidations = array_key_exists("validations", $schemaFieldDefinition);



                    if ($hasvalidations) {
                        $validations = $schemaFieldDefinition["validations"];
                        $validationParameters = convertSchemaToValidationArray($field, $validations);

                        $input = [strtolower($field) => $value];
                        $validator = \Validator::make($input, $validationParameters);

                        if (strpos($field, '.') !== false) {
                            $field = 'json.'.$field;
                        }
                        if (strpos($field, '->') !== false) {
                            $newArray[] = ['json->' . convertDotsToArrows($field), $value];
                        } else {
                            $newArray[] = [$field, $value];
                        }

                        $response['meta']['fields'][$field]['valid'] = $validator->passes();
                        $response['meta']['fields'][$field]['errors'] = $validator->errors($field);
                        $response['meta']['fields'][$field]['first_error'] = $validator->errors($field)->first();
                        foreach ($response['meta']['fields'] as $field => $result) {
                            if ($result['valid'] == false) {
                                $errors[$field] = "Error";
                            }
                        }
                    } else {
                        if (strpos($field, '->') !== false) {
                            $newArray[] = ['json->' . convertDotsToArrows($field), $value];
                        } else {
                            $newArray[] = [$field, $value];
                        }

                    }

                }


            } else {
                throw new \Exception("No input data");
            }

            if (count($errors) > 0) {
                $response['errors'] = $validator->errors();
                $response["status"] = "error";
                $response["message"] = "Validation failed.";
            } else {


                $response["message"] = "Validation successful.";


                if ($request->input('save') == true) {

                    $item->json = null;


                    foreach ($newArray as $field => $data) {

                        if (strpos($data[0], '.') !== false) {
                            $fieldString = convertDotsToArrows("json." . $data[0]);
                        } else {
                            $fieldString = $data[0];
                        }


                        if($item->overRideEdit() == true){

                            $item = $item->objectToEdit();
                            if($item != null){
                                $item->forceFill([
                                    $fieldString => $data[1]
                                ]);

                                $item->save();
                            }

                        }

                        else {

                            $item->forceFill([
                                $fieldString => $data[1]
                            ]);
                        }

                        if($item->postSave() == true){
                            //$item->postSave(true);
                        }

                    }
                    unset($item->schema);

                    if(Schema::hasColumn($item->getTable(), 'author_id')){
                        $item->author_id = \Auth::user()->id;
                    }
                    if(Schema::hasColumn($item->getTable(), 'user_id')) {
                        $item->user_id = \Auth::user()->id;
                    }


                    if($item->slug == null){
                        $item->slug = createSlug($item->title);
                    }

                    $item->save();
                    $item->schema = $item->schema();

                    $response["message"] = "Input saved.";
                }

                $response["status"] = "success";

            }

            $response['data'] = $item;
            $response["meta"]["input"] = $request->input();
            return response($response, 200);

        } else abort(404);
    }

    public function delete(Request $request, $type, $id)
    {
        if (isResource($type)) {
            $name = "\\App\\$type";
            if ($request->input('undelete') == 'true' && $request->input('save') == 'true') {
                $item = $name::withTrashed()->find($id);
                $item->restore();
                $item->save();
            } else {
                $item = $name::where('id', '=', $id)->first();
            }
        }
        $item->delete();
        $response["status"] = "success";
        $response["message"] = "Item deleted.";
        $response['data'] = null;
        return $response;
    }

    public function edit(Request $request, $type, $id)
    {
        $response = [];
        if (isResource($type)) {
            $type = ucwords(pathToModel($type));
            $name = "\\App\\$type";
            if ($request->input('undelete') == 'true' && $request->input('save') == 'true') {
                $item = $name::withTrashed()->find($id);
                $item->restore();
                $item->save();
            } else {
                $item = $name::where('id', '=', $id)->first();
            }


            $schema = json_decode(json_encode($item->schema(), true));
            $jsonInput = $request->input('data');

            if (gettype($jsonInput) != 'array') {
                $jsonInput = json_decode($jsonInput, true);
            }

            $tags = json_decode($request->input('tags'));
            if ($tags !== null) {
                foreach ($tags as $action => $tag) {
                    if ($action == 'add') {
                        $item->tag($tag);
                    }
                    if ($action == 'untag') {
                        $item->untag($tag);
                    }
                }
            }

            //dd($item->overRideEdit());


            if ($jsonInput == null && ($request->input('delete') == null OR $request->input('undelete') == null)) {
                $response["status"] = "pending";
                $response["message"] = "No input.";
                $response['data'] = null;
                return $response;
            }


            $newArray = [];
            $errors = [];


            //if JSON has input data...
            if (isset($jsonInput)) {

                //foreach field
                foreach ($jsonInput as $field => $value) {

                    $schema = json_decode(json_encode($schema), true);
                    if (strpos($field, '.') !== false) {

                        $arrayIndexes = explode(".", $field);
                        $schemaFieldDefinition = (get_array_value($schema, $arrayIndexes));
                    } else {
                        if (isset($schema['fields'][$field])) {
                            $schemaFieldDefinition = $schema['fields'][$field];
                        } else {
                            $response["status"] = "error";
                            $response["message"] = "Invalid input: cannot write field '" . $field . "'";
                            $response["fields"] = [$field => ["errors" => "Cannot write field $field"]];
                            $response['data'] = null;
                            return $response;
                        }
                    }


                    if ($schemaFieldDefinition == false) {
                        $schemaFieldDefinition = [];
                    }

                    $hasvalidations = array_key_exists("validations", $schemaFieldDefinition);
                    //dd($hasvalidations);

                    if ($hasvalidations) {
                        $validations = $schemaFieldDefinition["validations"];
                        $validationParameters = convertSchemaToValidationArray($field, $validations);

                        $input = [strtolower($field) => $value];
                        $validator = \Validator::make($input, $validationParameters);


                        if (strpos($field, '->') !== false) {
                            $newArray[] = ['json->' . convertDotsToArrows($field), $value];
                        } else {
                            $newArray[] = [$field, $value];
                        }

                        $response['data']['fields'][$field]['valid'] = $validator->passes();
                        $response['data']['fields'][$field]['errors'] = $validator->errors($field);
                        $response['data']['fields'][$field]['first_error'] = $validator->errors($field)->first();
                        foreach ($response['data']['fields'] as $field => $result) {
                            if ($result['valid'] == false) {
                                $errors[$field] = "Error";
                            }
                        }
                    } else {
                        if (strpos($field, '->') !== false) {
                            $newArray[] = ['json->' . convertDotsToArrows($field), $value];
                        } else {
                            $newArray[] = [$field, $value];
                        }

                    }

                }

            } else {
                throw new \Exception("No input data");
            }


            if (count($errors) > 0) {
                $response["status"] = "error";
                $response["message"] = "Validation failed.";
            } else {

                $response["message"] = "Validation successful.";

                if ($request->input('save') == true) {

                    foreach ($newArray as $field => $data) {

                        if (strpos($data[0], '.') !== false) {
                            $fieldString = convertDotsToArrows("json." . $data[0]);
                        } else {
                            $fieldString = $data[0];
                        }


                        if($item->overRideEdit() == true){

                            $item = $item->objectToEdit();
                            if($item != null){
                                $item->forceFill([
                                    $fieldString => $data[1]
                                ]);
                                $item->save();
                            }

                        }

                        else {

                            $item->forceFill([
                                $fieldString => $data[1]
                            ]);
                        }

                        if($item->postSave() == true){
                            $item->postSave(true);
                        }


                    }
                    if (isset($jsonInput['slug'])) {
                        $item->slug = createSlug($request->input('data')['slug']);
                        //dd($item->slug);
                    }
                    if (isset($request->input('data')['title'])) {
                        $item->title = $request->input('data')['title'];
                    }
                    if (isset($request->input('data')['name'])) {
                        $item->name = $request->input('data')['name'];
                    }
                    if (isset($request->input('data')['status'])) {
                        if (strtolower($request->input('data')['status']) == 'published' OR strtolower($request->input('data')['status']) == 'pending' OR strtolower($request->input('data')['status']) == 'private' OR strtolower($request->input('data')['status']) == 'active' OR strtolower($request->input('data')['status']) == 'inactive') {
                            $item->status = strtoupper($request->input('data')['status']);
                        }
                    }
                    $item->save();

                    $response["message"] = "Input saved.";
                }
                $response["status"] = "success";

            }
            $response["meta"]["input"] = $request->input();
            return response($response, 200);
        } else {
            abort(404);
        }
    }

    public function count(Request $request)
    {
            $eventType = $request->input('event_type');
            if($eventType == null){
                $eventType = 'page viewed';
            }
            $name = "\\App\\AnalyticEvent";
            $model = new $name;
            $table = $model->getTable();
            //$query = DB::select(DB::raw('SELECT date(created_at), count(id) as TOTAL  FROM '.$table.' GROUP BY date(created_at) ORDER BY date(created_at)')); //Works


            if($request->input('format') != null){
                $format = $request->input('format');
            }

            else {
                $format = 'Y-m-d';
            }

            if($request->input('startDate') == null) {
                $from = new \Carbon\Carbon;
                $from = $from->subDays(30)->format($format);
            }
            else {
                $from = $request->input('startDate');
                $from = \Carbon\Carbon::parse($from)->format($format);
            }


        if($request->input('endDate') == null) {
            $to = new \Carbon\Carbon;
            $to = $to->format($format);
        }
        else {
            $to = $request->input('endDate');
            $to = \Carbon\Carbon::parse($to)->format($format);
        }


        //$query = DB::select(DB::raw('SELECT date(created_at), count(id) as TOTAL  FROM '.$table.' GROUP BY date(created_at) ORDER BY date(created_at)')); //Works
            //$query = DB::select(DB::raw('SELECT date(created_at) as CREATED, count(id) as TOTAL FROM '.$table.' WHERE date(created_at) >= \''.$from.'\' AND date(created_at) <= \''.$to.'\' GROUP BY CREATED ORDER BY CREATED')); //Works
            //$query = DB::select(DB::raw('SELECT date(created_at) as CREATED, count(id) as TOTAL FROM '.$table.' WHERE date(created_at) >= \''.$from.'\' AND date(created_at) <= \''.$to.'\' GROUP BY CREATED ORDER BY CREATED'));
        $query = DB::select(DB::raw('SELECT date(created_at) as CREATED, count(id) as TOTAL FROM '.$table.' WHERE date(created_at) >= \''.$from.'\' AND date(created_at) <= \''.$to.'\' AND event_type = \''.$eventType.'\' GROUP BY CREATED ORDER BY CREATED'));

            $period = \Carbon\CarbonPeriod::create($from, $to);

            $dates = [];

            // Iterate over the period
            foreach ($period as $date) {
                $dates[$date->format('Y-m-d')] = ["date" => $date->format('Y-m-d') ,"total" => 0];
            }

            foreach($query as $result){
                $dates[$result->created] = ["date" => $date->format('Y-m-d') ,"total" => $result->total];
            }

            $results = [];

            foreach($dates as $date){
                $results[] = $date;
            }



            //dd($query);

            return response()->json($results, 200);
        }

}