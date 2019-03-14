<?php

namespace App;

use App\Traits\IsApiResource;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model implements \Altek\Accountant\Contracts\Recordable
{
    use \Altek\Accountant\Recordable;

    use IsApiResource;

    public function preferenceSchema()
    {
        return $this->belongsTo('App\PreferenceSchema')->first();
    }

    public function user()
    {
        return $this->belongsTo('App\User')->first();
    }

    public function schema()
    {
        $path = file_get_contents(storage_path() . '/schemas/preference.json');
        $baseSchema = json_decode($path, true);
        if ($this->preferenceSchema() != null) {
            $customSchema = json_decode($this->preferenceSchema()->json, true);
        } else {
            $customSchema = [];
        }
        $merged = array_merge($baseSchema, $customSchema);
        $merged = json_decode(json_encode($merged));
        return $merged;
    }

    public function content()
    {
        $json = $this->json;
        return $json;
    }
}
