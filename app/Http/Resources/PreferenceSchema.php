<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PreferenceSchema extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $fields = [];
        $fields['id'] = $this->id;
        $fields['name'] = $this->name;
        $fields['description'] = $this->description;
        $fields['schema'] = $this->schema();
        $fields['json'] = $this->json;
        $fields = sparseFields($fields, 'preferenceschema');
        return $fields;
    }
}