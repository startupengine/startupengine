<?php

namespace App\Http\Controllers;

use App\PostType;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Voyager;
use Jaam\Mixpanel\DataExportApi;
use Jaam\Mixpanel\DataExportApiException;

class AppController extends Controller
{

    public function index()
    {
        return redirect('/app/pages');
    }

    public function login(Request $request)
    {
        if (\Auth::user()) {
            if (\Auth::user() && $request->input('redirect') !== null) {
                dd($request->input('redirect'));
                return redirect($request->input('redirect'));
            }
            else {
                return redirect('/');
            }
        } else {
            return view('app.login');
        }
    }

    public function api(Request $request)
    {
        $adminrole = Role::where('name', '=', 'admin')->firstOrFail();
        if (\Auth::user() && \Auth::user()->role_id == $adminrole->id) {
            return view('app.api.tokens');
        } else {
            abort(404);
        }

    }

}