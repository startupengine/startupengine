<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function view(){
        if(\Auth::user()) {
            $options = [
                'id' => \Auth::user()->id,
                'type' => 'user',
                'index_uri' => '/app/account',
                'buttons' => [],
                'show_metadata' => false
            ];
            return view('app.account.view')->with('options', $options);
        }
        else {
            abort(404);
        }
    }
}
