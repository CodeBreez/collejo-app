<?php

namespace Collejo\App\Modules\Auth\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Auth\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * The default location to be redirected once logged in.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Sends the login failed message to the user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendFailedLoginResponse()
    {
        return $this->printJson(false, [], trans('auth::auth.failed'));
    }

    /**
     * On successful authentication redirect to the intended url or to the default route.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticated()
    {
        // This is required to make the reauth screen not appear right after login
        Session::put('reauth-token', [
            'email' => Auth::user()->email,
            'ts'    => time(),
        ]);

        return $this->printJson(true, [
            'redir' => Session::get('url.intended', $this->redirectTo),
        ]);
    }

    /**
     * Returns the login form view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function showLoginForm()
    {
        return view('auth::login', [
            'login_form_validator' => $this->jsValidator(LoginRequest::class),
        ]);
    }

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'postReauth']]);

        $this->redirectTo = route('dash');
    }
}
