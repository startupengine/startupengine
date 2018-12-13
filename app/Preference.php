<?php

namespace App;

use App\Traits\IsApiResource;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{

    use IsApiResource;

    public function preferenceSchema()
    {
        return $this->belongsTo('App\PreferenceSchema')->first();
    }

    public function user()
    {
        return $this->belongsTo('App\User')->first();
    }


    public function schema() {

        $path = file_get_contents(storage_path().'/schemas/preference.json');
        $baseSchema = json_decode($path,  true);
        $customSchema = json_decode($this->preferenceSchema()->json, true);
        $merged = array_merge($baseSchema, $customSchema);
        $merged = json_decode(json_encode($merged));
        return $merged;
    }

    public function content() {
        $json = $this->json;
        return $json;
    }
}