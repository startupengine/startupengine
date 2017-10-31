<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchItem extends Model
{
    public function collection() {
        return $this->belongsTo('App\ResearchCollection');
    }
}