<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function json()
    {
        $json = json_decode($this->json);
        return $json;

    }
}
