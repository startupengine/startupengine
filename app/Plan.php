<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function json()
    {
        $json = json_decode($this->json);
        return $json;

    }
}
