<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Log extends JsonResource
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
        $fields['uuid'] = $this->getIdAttribute();
        $fields['description'] = $this->description();

        $fields['occurrences'] = count($this->occurrences());
        $fields['sequence'] = $this->sequence;
        $fields['type'] = $this->type;
        $fields['should_display_on_index'] = $this->should_display_on_index;
        if ($this->created_at != null) {
            $fields['created_at'] = $this->created_at->toDateTimeString();
        }
        $fields = sparseFields($fields, 'log');
        $fields['content'] = $this->content;
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
        return [
            'meta' => [
                'type' => 'log'
            ]
        ];
    }
}
