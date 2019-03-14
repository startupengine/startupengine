<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsGroup extends JsonResource
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
        $fields['value'] = $this->value;
        $fields['group'] = $this->group;
        $fields['items'] = $this->items();
        $fields = sparseFields($fields, 'role');
        return $fields;
    }
}
