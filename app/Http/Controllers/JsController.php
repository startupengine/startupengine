<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JsController extends Controller
{
        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Http\Response
         */
        public function render($file)
        {
            $path = resource_path().'/views/scripts/'.$file;
            //dd($path);
            //dd(file_exists($path));
            return file_get_contents($path);
        }
}
