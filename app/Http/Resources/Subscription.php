<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Subscription extends JsonResource
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
        $fields['slug'] = $this->slug;
        $fields['description'] = $this->description;
        $fields['price'] = $this->price;
        $fields['user_id'] = $this->user_id;
        $fields['stripe_id'] = $this->stripe_id;
        $fields['stripe_plan'] = $this->stripe_plan;
        if($this->created_at != null) {
            $fields['created_at'] = $this->created_at->toDateTimeString();
        }
        if($this->updated_at != null) {
            $fields['updated_at'] = $this->updated_at->toDateTimeString();
        }
        if($this->deleted_at != null) {
            $fields['deleted_at'] = $this->deleted_at->toDateTimeString();
        }
        $fields['schema'] = $this->schema();
        $fields['content'] = $this->content();
        $fields = sparseFields($fields, 'user');
        $fields['transformations'] = $this->transformations();
        return $fields;
    }
}
