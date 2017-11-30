<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function index() {
        if (\Auth::user()->role()->name !== 'admin') {
            abort(404);
        }
        return redirect('/app/settings?group=Theme');
    }

}
