<?php

namespace Collejo\App\Modules\Auth\Http\Controllers;

use Collejo\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{

    use ResetsPasswords;

    protected $linkRequestView = 'student::auth.password';
    
    protected $resetView = 'student::auth.reset';

    public function __construct()
    {
        $this->middleware('guest');
    }
}
