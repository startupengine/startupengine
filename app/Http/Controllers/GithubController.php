<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;

class GithubController extends Controller
{

    public function json($path) {
        $repo = GitHub::repo()->contents()->show(config('app.template_git_username'), config('app.template_git_repository'), $path);
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
        $url = "https://raw.githubusercontent.com/".config('app.template_git_username')."/".config('app.template_git_repository')."/".config("app.template_git_branch")."/".$path;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    public function info($path) {
        $repo = GitHub::repo()->contents()->show(config('app.template_git_username'), config('app.template_git_repository'), $path);
        return response()
            ->json($repo);
    }
}