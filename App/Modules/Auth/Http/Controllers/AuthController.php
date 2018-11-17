<?php

namespace Collejo\App\Modules\Auth\Http\Controllers;

use Collejo\App\Http\Controller;
use Request;
use Session;
use Auth;
use URL;
use Hash;

class AuthController extends Controller
{
    public function postReauth(Request $request, Session $session)
    {
        if (Hash::check($request::get('password'), Auth::user()->password)) {
            $session::put('reauth-token', [
                'email' => Auth::user()->email,
                'ts'    => time(),
            ]);

            return $this->printJson(true, ['redir' => URL::previous()]);
        }

        return $this->printJson(false, [], trans('auth::auth.failed'));
    }

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'postReauth']]);
    }
}
