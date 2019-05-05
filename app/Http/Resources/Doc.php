<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class Doc extends JsonResource
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
        $fields['title'] = $this->title();
        $fields['slug'] = $this->slug;
        $fields['url'] =
            URL::to('/') . str_replace("docs/content/", "docs/", $this->path);
        $folder = str_replace("/docs/content/", "", $this->path);
        $folder = str_replace($this->slug, "", $folder);
        $folder = rtrim($folder, '/');
        $folder = str_replace("_", " ", $folder);
        $fields['folder'] = $folder;
        $fields['status'] = $this->status;
        $fields['path'] = $this->path;

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
        $fields['content'] = $this->content;
        $fields['highlighted'] = $this->highlightedSearchResults();
        $fields['transformations'] = $this->transformations();
        $fields = sparseFields($fields, 'doc');
        return $fields;
    }
}
