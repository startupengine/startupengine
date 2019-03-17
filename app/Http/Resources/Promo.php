<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class Promo extends JsonResource
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
        //Add included relationships
        $relations = addIncludedRelationshipsToApiResource(request(), $this);
        $fields['included'] = $relations;
        $fields['id'] = $this->id;
        $fields['hashid'] = $this->getHashid();
        $fields['href'] = URL::to('/') . '/promo/' . $this->getHashid();
        $fields['status'] = $this->status;
        $fields['slug'] = $this->slug;
        $fields['tags'] = $this->tags;
        $fields['thumbnail'] = $this->thumbnail();
        //dd($this->postType()->schema());
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
        $fields = sparseFields($fields, 'content');

        return $fields;
    }
}
