<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function json()
    {
        return json_decode($this->json);
    }
}
