<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Setting extends JsonResource
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
        $fields['display_name'] = $this->display_name;
        $fields['key'] = $this->key;
        $fields['value'] = $this->value;
        $fields['type'] = $this->type;
        $fields['group'] = $this->group;
        $fields['status'] = $this->status;
        $fields['details'] = $this->details;
        $fields['content'] = $this->content();
        $fields['schema'] = $this->schema();
        $fields = sparseFields($fields, 'setting');
        return $fields;
    }
}