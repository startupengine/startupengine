<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPreferencesController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = \App\User::find($id);
        return view('admin.users.preferences.index')->with('user', $user);
    }
}