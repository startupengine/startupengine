<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentfulController extends Controller
{
    public function import() {
        $contentful = new \App\Contentful;
        $output = $contentful->import();
        return redirect ('/install/import-complete');
    }
}
