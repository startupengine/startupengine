<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BeyondCode\LaravelWebSockets\Apps\AppProvider;

class WebsocketController extends Controller
{
    public function index(Request $request, AppProvider $apps)
    {
        return view('admin.websockets.index', [
            'apps' => $apps->all()
        ]);
    }
}
