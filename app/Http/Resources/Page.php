<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Page extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //$startDate = \Carbon\Carbon::now()->subDays(30)->toDateTimeString();
        //dd($startDate);
        //dd($this);
        //$views = $this->views()->where('created_at', '>=', $startDate)->get();
        //dd($this->views);
        //dd($views);
        //dd($startDate);
        $fields = [];
        $fields['id'] = $this->id;
        if (\Request::route()->getName() != 'ReadApiResource') {
            $fields['links'] = $this->links();
        }

        //Add included relationships
        $relations = addIncludedRelationshipsToApiResource(request(), $this);
        $fields['included'] = $relations;
        $fields['thumbnail'] = $this->thumbnail();
        $fields['views'] = count($this->views()->get());
        //dd($fields['views']);
        $fields['status'] = $this->status;
        $fields['slug'] = $this->slug;
        $fields['tags'] = $this->tags;
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
        $fields['meta_description'] = $this->meta_description;
        $fields['schema'] = $this->schema();
        $fields['content'] = $this->content();
        $fields = sparseFields($fields, 'page');
        return $fields;
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [];
    }
}
