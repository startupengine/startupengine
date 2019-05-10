<?php

namespace App;

use App\Traits\IsApiResource;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model implements \Altek\Accountant\Contracts\Recordable
{
    use IsApiResource;

    use \Altek\Accountant\Recordable;

    protected $fillable = ['value', 'schema'];

    protected $casts = ['json' => 'json', 'schema' => 'json'];

    public function appSettings()
    {
        $settings = \App\Setting::whereIn('key', [
            'site.title',
            'site.description',
            'admin.title',
            'admin.description',
            'site.google_analytics_tracking_id',
            'admin.google_analytics_client_id'
        ])->get();
        return $settings;
    }

    public function schema()
    {
        $path = file_get_contents(storage_path() . '/schemas/setting.json');
        $baseSchema = json_decode($path, true);

        if (
            file_exists(
                storage_path() . '/schemas/settings/' . $this->key . ".json"
            )
        ) {
            $file = file_get_contents(
                storage_path() . '/schemas/settings/' . $this->key . ".json"
            );
            $schema = json_decode($file, true);
        } else {
            $schema = null;
        }

        if ($schema == null) {
            $schema = [];
        }
        $merged = array_merge($baseSchema, $schema);
        $merged = json_decode(json_encode($merged));
        return $merged;
    }

    public function content()
    {
        $json = json_decode(json_encode($this->json));

        return $json;
    }
}
