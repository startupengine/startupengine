<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Role extends JsonResource
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
        if($this->created_at != null) {
            $fields['created_at'] = $this->created_at->toDateTimeString();
        }
        if($this->updated_at != null) {
            $fields['updated_at'] = $this->updated_at->toDateTimeString();
        }
        if($this->name != null) {
            $fields['name'] = $this->name;
        }
        $fields['display_name'] = $this->display_name;
        $fields = sparseFields($fields, 'role');
        return $fields;
    }
}
