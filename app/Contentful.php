<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contentful extends Model
{
    public function import() {
        \Artisan::call('config:clear');
        \Artisan::call('config:cache');
        $path = \Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $path = $path.'contentful/default-space.json';
        $apikey = config('app.CONTENTFUL_API_KEY');
        $space = config('app.CONTENTFUL_SPACE_ID');
        $token = config('app.CONTENTFUL_MANAGEMENT_TOKEN');
        echo $space."\n";
        echo $token."\n";
        echo $apikey."\n";
        $string = "contentful-import --management-token $token --space-id $space --content-file $path";
        exec($string, $output);
        return $output;
    }

    public function export() {
        \Artisan::call('config:clear');
        \Artisan::call('config:cache');
        $path = \Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $path = $path.'backups/contentful/';
        $space = config('app.CONTENTFUL_SPACE_ID');
        $apikey = config('app.CONTENTFUL_API_KEY');
        $token = config('app.CONTENTFUL_MANAGEMENT_TOKEN');
        echo $space."\n";
        echo $token."\n";
        echo $apikey."\n";
        $string = "contentful-export --management-token $token --space-id $space --download-assets --export-dir $path";
        exec($string, $output);
        return $output;
    }
}
