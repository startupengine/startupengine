<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public function raw($path)
    {
        $url = "https://raw.githubusercontent.com/".env('GITHUB_USERNAME')."/".env('GITHUB_REPOSITORY')."/".env("GITHUB_REPOSITORY_BRANCH")."/".$path;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}
