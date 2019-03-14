<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Preference extends JsonResource
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
        $fields['name'] = $this->preferenceSchema()->name;
        $fields['description'] = $this->preferenceSchema()->description;
        $fields['user'] = $this->user();
        $fields['status'] = $this->status;
        $fields['schema'] = $this->schema();
        $fields['content'] = $this->content();
        $fields = sparseFields($fields, 'preference');
        return $fields;
    }
}
