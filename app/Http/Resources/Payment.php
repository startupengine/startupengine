<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Payment extends JsonResource
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
        $fields['user_id'] = $this->user_id;
        $fields['amount'] = $this->amount;
        $fields['currency'] = $this->currency;
        $fields['description'] = $this->description;

        if($this->created_at != null) {
            $fields['created_at'] = $this->created_at->toDateTimeString();
        }
        if($this->updated_at != null) {
            $fields['updated_at'] = $this->updated_at->toDateTimeString();
        }
        if($this->deleted_at != null) {
            $fields['deleted_at'] = $this->deleted_at->toDateTimeString();
        }
        $fields = sparseFields($fields, 'payment');
        return $fields;
    }
}
