<?php

namespace Collejo\App\Modules\Auth\Http\Controllers;

use Collejo\App\Repository\UserRepository;
use Validator;
use Collejo\App\Http\Controllers\Controller;
use Collejo\Core\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/';
    
    protected $loginView = 'auth::login';

    protected $registerView = 'auth::register';

    public function sendFailedLoginResponse()
    {
        return $this->printJson(false, [], trans('auth::auth.failed'));
    }

    public function authenticated()
    {
        return $this->printJson(true, ['redir' => '/dash']);
    }

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
}
