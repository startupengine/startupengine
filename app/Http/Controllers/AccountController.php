<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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
            elseif($accountView == 'settings') {
                return view('app.account.settings')->with('options', $options);
            }
            elseif($accountView == 'payment') {
                return view('app.account.payment')->with('options', $options);
            }
            elseif($accountView == 'subscriptions') {
                return view('app.account.subscriptions')->with('options', $options);
            }
            elseif($accountView == 'products') {
                return view('app.account.products')->with('options', $options);
            }
            else {
                abort(404);
            }
        }
        else {
            abort(404);
        }
    }

    public function subView($accountView, $subView){
        if(\Auth::user()) {
            if(in_array($subView, ["view"]) && View::exists("app.account.$accountView.$subView")) {
                return view("app.account.$accountView.$subView")->with('options', null);
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
