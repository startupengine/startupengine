<?php

namespace App;

use App\Traits\IsApiResource;
use Illuminate\Database\Eloquent\Model;

class PreferenceSchema extends Model implements \Altek\Accountant\Contracts\Recordable
{
    use \Altek\Accountant\Recordable;

    use IsApiResource;

    public function content()
    {
        $path = $this->json;
        $json = json_decode($path, true);
        return $json;
    }

    public function schema()
    {
        $path = file_get_contents(storage_path().'/schemas/preference_schema.json');
        $baseSchema = json_decode($path);
        return $baseSchema;
    }
}
