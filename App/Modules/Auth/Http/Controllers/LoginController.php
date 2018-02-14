<?php

namespace Collejo\App\Modules\Auth\Http\Controllers;

use Collejo\App\Http\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function sendFailedLoginResponse()
    {
        return $this->printJson(false, [], trans('auth::auth.failed'));
    }

    public function authenticated()
    {
        return $this->printJson(true, ['redir' => Session::get('url.intended', $this->redirectTo)]);
    }

    public function showLoginForm()
    {
        return view('auth::login');
    }

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'postReauth']]);
    }
}
