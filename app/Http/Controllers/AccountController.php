<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function view($accountView){
        if(\Auth::user()) {
            $options = [
                'id' => \Auth::user()->id,
                'type' => 'user',
                'index_uri' => '/app/account',
                'buttons' => [],
                'show_metadata' => false
            ];
            if($accountView == 'account') {
                return view('app.account.profile')->with('options', $options);
            }
            if($accountView == 'payment') {
                return view('app.account.payment')->with('options', $options);
            }
            else {
                abort(404);
            }
        }
        else {
            abort(404);
        }
    }
}
