<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function raw($path)
    {
        $url = "https://raw.githubusercontent.com/" . env('GITHUB_USERNAME') . "/" . env('GITHUB_REPOSITORY') . "/" . env("GITHUB_REPOSITORY_BRANCH") . "/pages/" . $path;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpCode == 404) {
            return null;
            curl_close($curl);
        } else {
            curl_close($curl);
            return $output;
        }
    }

    public function json()
    {
        $json = \Config::get('view.paths')[0] . '/theme/pages/' . $this->slug . '/page.json';

        if (file_exists($json)) {
            return json_decode(file_get_contents($json));
        } else {
            return null;
        }

    }

    public function versions() {
        $json = json_decode($this->json, TRUE);
        $versions = count($json['versions']);
        if($versions == null) { $versions = 0; }

        return $versions;
    }
}