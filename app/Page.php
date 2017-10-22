<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function raw($path) {
        $url = "https://raw.githubusercontent.com/".env('GITHUB_USERNAME')."/".env('GITHUB_REPOSITORY')."/".env("GITHUB_REPOSITORY_BRANCH")."/pages/".$path;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if($httpCode == 404) {
            return null;
            curl_close($curl);
        }
        else {
            curl_close($curl);
            return $output;
        }
    }
}