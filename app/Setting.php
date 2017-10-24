<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function appSettings() {
        $settings = \App\Setting::whereIn('key', ['site.title', 'site.description', 'admin.title', 'admin.description', 'site.google_analytics_tracking_id', 'admin.google_analytics_client_id'])
            ->get();
        return $settings;
    }
}
