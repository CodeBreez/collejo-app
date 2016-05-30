<?php

namespace Collejo\Http\Controllers\Auth;

use Collejo\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{

    use ResetsPasswords;

    protected $linkRequestView = 'collejo::auth.password';
    
    protected $resetView = 'collejo::auth.reset';

    public function __construct()
    {
        $this->middleware('guest');
    }
}
