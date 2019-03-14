<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function index() {
        return redirect('/app/settings?group=Theme');
    }

}
