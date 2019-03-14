<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/app/account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:60,1')->only('verify', 'resend');
    }

    public function verify($id = null)
    {
        $request = request();
        if ($request->hasValidSignature()) {
            $user = \App\User::find($id);
            $user->email_verified_at = \Carbon\Carbon::now()->toDateTimeString();
            $user->save();
            return view('app.verified');
        } else {
            return view('auth.verify');
        }
    }
}
