<?php

namespace Collejo\Http\Controllers\Auth;

use Collejo\Models\User;
use Validator;
use Collejo\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Collejo\Core\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';
    
    protected $loginView = 'collejo::auth.login';

    protected $registerView = 'collejo::auth.register';

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

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
