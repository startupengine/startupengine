<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;

class AppController extends Controller
{
    public function login()
    {
        \Auth::logout();
        return \App::make('auth0')->login();
    }
}