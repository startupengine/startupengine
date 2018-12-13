<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laraquick\Controllers\Traits\Api;
use App\Model;

class ModelController extends Controller
{
    use Api;

    protected function model() {
        return Model::class;
    }

    protected function validationRules(array $data, $id = null) {
        return [
            'title' => 'required|string|max:50',
            'content' => 'sometimes|string',
            'deadline' => 'sometimes|date'
        ];
    }
}
