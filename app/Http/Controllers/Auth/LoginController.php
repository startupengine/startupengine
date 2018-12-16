<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout() {
        \Auth::logout();
        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        if(setting('site.homepage') != null){
            $setting = setting('site.homepage');
            $page = \App\Page::where('slug', $setting)->where('status', 'ACTIVE')->first();
            if($page != null){
                $route = '/'.$page->slug;
            }
        }
        if(!isset($route) && \Auth::user()->hasPermissionTo('view backend') == true) {
            $route = '/admin';
        }
        else {
            $route = '/app/account';
        }
        return redirect($route);
    }

}