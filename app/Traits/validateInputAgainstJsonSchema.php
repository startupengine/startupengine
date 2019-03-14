<?php

namespace App\Traits;

trait validateInputAgainstJsonSchema
{
    public function validateInput($request)
    {

        if ($request->input('undelete') == 'true' && $request->input('save') == 'true') {
            $this - restore();
            $this->save();
        }

        $schema = json_decode(json_encode($this->schema()), true);
        $jsonInput = json_decode($request->input('json'), true);
        $response = [];

        $tags = json_decode($request->input('tags'));
        if ($tags !== null) {
            foreach ($tags as $action => $tag) {
                if ($action == 'add') {
                    $this->tag($tag);
                }
                if ($action == 'untag') {
                    $this->untag($tag);
                }
            }
        }

        if ($jsonInput == null && $request->input('title') == null && $request->input('slug') == null && $request->input('status') == null && $request->input('delete') == null) {
            $response["status"] = "pending";
            $response["message"] = "No input.";
            $response['data'] = null;
            return $response;
        }

        $newArray = [];
        $errors = [];
        if ($jsonInput !== null) {
            foreach ($jsonInput as $field => $value) {
                if (strpos($field, '.') !== false) {
                    $arrayIndexes = explode(".", $field);
                }
                $schemaFieldDefinition = (get_array_value($schema, $arrayIndexes));
                if ($schemaFieldDefinition == false) {
                    $schemaFieldDefinition = [];
                }

                $hasvalidations = array_key_exists("validations", $schemaFieldDefinition);
                if ($hasvalidations) {
                    $validations = $schemaFieldDefinition["validations"];
                    $validationParameters = convertSchemaToValidationArray($field, $validations);
                    $input = [strtolower($field) => $value];
                    $validator = \Validator::make($input, $validationParameters);
                    $newArray[] = ['json->' . convertDotsToArrows($field), $value];
                    $response['data']['fields'][$field]['valid'] = $validator->passes();
                    $response['data']['fields'][$field]['errors'] = $validator->errors($field);
                    $response['data']['fields'][$field]['first_error'] = $validator->errors($field)->first();
                    foreach ($response['data']['fields'] as $field => $result) {
                        if ($result['valid'] == false) {
                            $errors[$field] = "Error";
                        }
                    }
                } else {
                    $newArray[] = ['json->' . convertDotsToArrows($field), $value];
                }
            }
        }

        if (count($errors) > 0) {
            $response["status"] = "error";
            $response["message"] = "Validation failed.";
        } else {
            $response["message"] = "Validation successful.";
            if ($request->input('save') != null) {
                foreach ($newArray as $field => $data) {
                    $this->forceFill([
                        $data[0] => $data[1]
                    ]);
                }
                if ($request->input('slug') !== null) {
                    $this->slug = createSlug($request->input('slug'));
                }
                if ($request->input('title') !== null) {
                    $this->title = $request->input('title');
                }
                if ($request->input('status') !== null) {
                    if (strtolower($request->input('status')) == 'published' or strtolower($request->input('status')) == 'pending' or strtolower($request->input('status')) == 'private') {
                        $this->status = strtoupper($request->input('status'));
                    }
                }
                if ($request->input('delete') == 'true') {
                    $this->delete();
                } else {
                    $this->save();
                }
                $response["message"] = "Input saved.";
            }
            $response["status"] = "success";
        }

        return $response;
    }
}
