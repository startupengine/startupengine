<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
        $fields['email'] = $this->email;
        $fields['avatar'] = $this->avatar;
        $fields['status'] = $this->status;
        $fields['bio'] = $this->bio;
        if($this->created_at != null) {
            $fields['created_at'] = $this->created_at->toDateTimeString();
        }
        if($this->updated_at != null) {
            $fields['updated_at'] = $this->updated_at->toDateTimeString();
        }
        if($this->deleted_at != null) {
            $fields['deleted_at'] = $this->deleted_at->toDateTimeString();
        }
        if($this->first_name != null) {
            $fields['name'] = $this->first_name;
        }
        $fields['schema'] = $this->schema();
        $fields['content'] = $this->content();
        $fields = sparseFields($fields, 'user');
        return $fields;
    }
}