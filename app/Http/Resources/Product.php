<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
        $fields['status'] = $this->status;
        $fields['slug'] = $this->slug;
        $fields['tags'] = $this->tags;
        $fields['purchases'] = count($this->purchases()->get());
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
        if ($this->title != null) {
            $fields['title'] = $this->title;
        }
        if ($this->name != null) {
            $fields['name'] = $this->name;
        }
        $fields['schema'] = $this->schema();
        $fields['content'] = $this->content();
        $fields['transformations'] = $this->transformations();
        $fields['features'] = $this->features()->get();
        $fields = sparseFields($fields, 'product');
        return $fields;
    }
}
