<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Feature extends JsonResource
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
        $fields['status'] = $this->status;
        $fields['tags'] = $this->tags;
        $fields['thumbnail'] = $this->thumbnail();
        if ($this->created_at != null) {
            $fields['created_at'] = $this->created_at->toDateTimeString();
        }
        if ($this->updated_at != null) {
            $fields['updated_at'] = $this->updated_at->toDateTimeString();
        }
        if ($this->deleted_at != null) {
            $fields['deleted_at'] = $this->deleted_at->toDateTimeString();
        }

        $fields['schema'] = $this->schema();
        $fields['content'] = $this->content();
        $fields['products'] = $this->products()->get();
        $fields['transformations'] = $this->transformations();
        $fields = sparseFields($fields, 'product');
        return $fields;
    }
}
