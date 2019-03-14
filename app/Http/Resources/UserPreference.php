<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPreference extends JsonResource
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
        if ($request->input('user_id') != null) {
            $userId = $request->input('user_id');
            $content = json_decode($this->resource->content($userId));
            $fields['content'] = $content;
        }

        $fields = sparseFields($fields, 'preferenceschema');
        return $fields;
    }
}
