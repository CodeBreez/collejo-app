<?php

namespace Collejo\App\Modules\Auth\Http\Controllers;

use Collejo\App\Repository\UserRepository;
use Validator;
use Collejo\App\Http\Controllers\Controller;
use Collejo\App\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Session;
use Request;
use Hash;
use Auth;
use URL;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/';

    protected $redirectAfterLogout = '/';
    
    protected $loginView = 'auth::login';

    protected $registerView = 'auth::register';

    public function sendFailedLoginResponse()
    {
        return $this->printJson(false, [], trans('auth::auth.failed'));
    }

    public function authenticated()
    {
        return $this->printJson(true, ['redir' => Session::get('url.intended', '/dash')]);
    }

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'postReauth']]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(UserRepository $userRepository, array $data)
    {
        return $userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function postReauth(Request $request, Session $session)
    {
        if (Hash::check($request::get('password'), Auth::user()->password)) {
            $session::put('reauth-token', [
                    'email' => Auth::user()->email,
                    'ts' => time()
                ]);

            return $this->printJson(true, ['redir' => URL::previous()]); 
        }

        return $this->printJson(false, [], trans('auth::auth.failed'));
    }
}
