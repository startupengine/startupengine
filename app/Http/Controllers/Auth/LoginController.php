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

    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }

    public function redirectLink()
    {
        if (url()->previous() != null) {
            return url()->previous();
        } else {
            return '/login';
        }
    }

    public function register()
    {
        if (\Auth::user()) {
            return redirect('/');
        } else {
            return view('app.register');
        }
    }

    public function showLoginForm(Request $request)
    {
        session(['link' => url()->previous()]);
        if (\Auth::user()) {
            if (\Auth::user() && $request->input('redirect') !== null) {
                return redirect($request->input('redirect'));
            } else {
                if (setting('site.homepage') != null) {
                    $route = setting('site.homepage');
                    $page = \App\Page::where('slug', $route)->first();
                    if ($page != null) {
                        $route = '/' . $page->slug;
                    } else {
                        $route = '/app/account';
                    }
                } elseif (\Auth::user()->hasPermissionTo('view backend')) {
                    $route = '/admin';
                } else {
                    $route = '/';
                }
                return redirect($route);
            }
        } else {
            return view('app.login');
        }
    }

    protected function authenticated(Request $request, $user)
    {
        if (setting('site.homepage') != null) {
            $setting = setting('site.homepage');
            $page = \App\Page::where('slug', $setting)
                ->where('status', 'ACTIVE')
                ->first();
            if ($page != null) {
                $route = '/' . $page->slug;
            }
        }
        if (
            !isset($route) &&
            \Auth::user()->hasPermissionTo('view backend') == true
        ) {
            $route = '/admin';
        } else {
            $route = '/app/account';
        }

        if (session('link') != null) {
            return redirect(session('link'));
        } else {
            return redirect($route);
        }
    }
}
