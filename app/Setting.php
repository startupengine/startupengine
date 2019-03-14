<?php

namespace App;

use App\Traits\IsApiResource;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model implements \Altek\Accountant\Contracts\Recordable
{
    use IsApiResource;

    use \Altek\Accountant\Recordable;

    protected $fillable = ['value'];
    protected $casts = ['json' => 'json'];

    public function appSettings()
    {
        $settings = \App\Setting::whereIn('key', ['site.title', 'site.description', 'admin.title', 'admin.description', 'site.google_analytics_tracking_id', 'admin.google_analytics_client_id'])
            ->get();
        return $settings;
    }

    public function schema()
    {
        $path = file_get_contents(storage_path().'/schemas/setting.json');
        $baseSchema = json_decode($path, true);
        $settingSchema = json_decode($this->schema, true);
        if ($settingSchema == null) {
            $settingSchema = [];
        }
        $merged = array_merge($baseSchema, $settingSchema);
        $merged = json_decode(json_encode($merged));
        return $merged;
    }

    public function content()
    {
        $json = json_decode(json_encode($this->json));

        return $json;
    }
}
