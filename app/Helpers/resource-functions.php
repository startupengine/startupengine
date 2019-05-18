<?php

function sparseFields($array, $model)
{
    $requestedFields = request()->input('fields');
    if ($requestedFields != null && count($requestedFields) > 0) {
        $requestedFields = explode(',', $requestedFields[$model]);
        $results = [];
        foreach ($array as $item => $value) {
            if (in_array($item, $requestedFields)) {
                $results[$item] = $value;
            }
        }
        return $results;
    } else {
        return $array;
    }
}
