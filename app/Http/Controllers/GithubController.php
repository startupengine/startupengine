<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;

class GithubController extends Controller
{

    public function json($path) {
        $repo = GitHub::repo()->contents()->show(env('GITHUB_USERNAME'), env('GITHUB_REPOSITORY'), $path);
        $url = $repo['download_url'];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        $repo['raw'] = $output;
        $repo = ['raw' => $output];
        return response()
            ->json($repo);
    }

    public function raw($path) {
        //$repo = GitHub::repo()->contents()->show(, , $path);
        //$url = $repo['download_url'];
        $url = "https://raw.githubusercontent.com/".env('GITHUB_USERNAME')."/".env('GITHUB_REPOSITORY')."/".env("GITHUB_REPOSITORY_BRANCH")."/".$path;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    public function info($path) {
        $repo = GitHub::repo()->contents()->show(env('GITHUB_USERNAME'), env('GITHUB_REPOSITORY'), $path);
        return response()
            ->json($repo);
    }
}