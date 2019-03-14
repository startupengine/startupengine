<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    function create(Request $request)
    {
        $type = 'user';
        if (isResource($type)) {
            $type = pathToModel($type);
            $name = "\\App\\$type";
            $model = new $name();
            $model->schema = $model->schema();

            $jsonInput = $request->input('data');
            $schema = $model->schema();

            $newArray = [];
            $errors = [];
            $item = $model;

            $requiredFields = [];
            foreach ($schema->fields as $key => $schemaField) {
                if (isset($schemaField->validations->required)) {
                    $requiredFields[$key] = $model->$key;
                }
            }
            $jsonInput = array_merge($requiredFields, $jsonInput);
            if (isset($schema->sections)) {
                $requiredJsonFields = [];
                foreach ($schema->sections as $key => $sectionContents) {
                    foreach ($sectionContents->fields
                    as $virtualField => $fieldContents) {
                        if (isset($fieldContents->validations->required)) {
                            $requiredJsonFields[
                                'json.sections.' .
                                    $key .
                                    '.fields.' .
                                    $virtualField
                            ] = null;
                        }
                    }
                }

                $jsonInput = array_merge($requiredJsonFields, $jsonInput);
            }

            //if JSON has input data...
            if (isset($jsonInput)) {
                //dd($jsonInput);

                //foreach field
                foreach ($jsonInput as $field => $value) {
                    $schema = json_decode(json_encode($schema), true);

                    if (strpos($field, '.') !== false) {
                        $field = explode('json.', $field);
                        $field = $field[1];
                        $arrayIndexes = explode(".", $field);

                        $schemaFieldDefinition = get_array_value(
                            $schema,
                            $arrayIndexes
                        );
                    } else {
                        if (isset($schema['fields'][$field])) {
                            $schemaFieldDefinition = $schema['fields'][$field];
                        } else {
                            $response["status"] = "error";
                            $response["message"] =
                                "Invalid input: cannot write field '" .
                                $field .
                                "'";
                            $response["fields"] = [
                                $field => [
                                    "errors" => "Cannot write field $field"
                                ]
                            ];
                            $response['data'] = null;
                            return $response;
                        }
                    }

                    if ($schemaFieldDefinition == false) {
                        $schemaFieldDefinition = [];
                    }

                    $hasvalidations = array_key_exists(
                        "validations",
                        $schemaFieldDefinition
                    );

                    if ($hasvalidations) {
                        $validations = $schemaFieldDefinition["validations"];
                        $validationParameters = convertSchemaToValidationArray(
                            $field,
                            $validations
                        );

                        $input = [strtolower($field) => $value];
                        $validator = \Validator::make(
                            $input,
                            $validationParameters
                        );

                        if (strpos($field, '.') !== false) {
                            $field = 'json.' . $field;
                        }
                        if (strpos($field, '->') !== false) {
                            $newArray[] = [
                                'json->' . convertDotsToArrows($field),
                                $value
                            ];
                        } else {
                            $newArray[] = [$field, $value];
                        }

                        $response['meta']['fields'][$field][
                            'valid'
                        ] = $validator->passes();
                        $response['meta']['fields'][$field][
                            'errors'
                        ] = $validator->errors($field);
                        $response['meta']['fields'][$field][
                            'first_error'
                        ] = $validator->errors($field)->first();
                        foreach ($response['meta']['fields']
                        as $field => $result) {
                            if ($result['valid'] == false) {
                                $errors[$field] = "Error";
                            }
                        }
                    } else {
                        if (strpos($field, '->') !== false) {
                            $newArray[] = [
                                'json->' . convertDotsToArrows($field),
                                $value
                            ];
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

                    $item->name = $request->input('data')['name'];
                    $item->email = $request->input('data')['email'];
                    $item->password = Hash::make(
                        $request->input('data')['password']
                    );

                    unset($item->schema);

                    $item->save();
                    $item->sendEmailVerificationNotification();
                    $item->schema = $item->schema();

                    $response["message"] = "Input saved.";
                }

                $response["status"] = "success";
            }

            $response['data'] = $item;
            $response["meta"]["input"] = $request->input();
            return response($response, 200);
        } else {
            abort(404);
        }
    }
}
