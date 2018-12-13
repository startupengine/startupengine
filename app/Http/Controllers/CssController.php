<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
