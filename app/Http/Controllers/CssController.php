<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CssController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view('css');
    }

    public function view($file)
    {
        $path = resource_path().'/views/styles/'.$file;
        $contents = file_get_contents($path);
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'text/css');
        //dd($response);
        return $response;
    }
}
