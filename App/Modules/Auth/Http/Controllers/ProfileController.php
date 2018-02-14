<?php

namespace Collejo\App\Modules\Auth\Http\Controllers;

use Auth;
use Collejo\App\Http\Controller;

class ProfileController extends Controller
{
    public function getProfile()
    {
        return view('auth::profile', ['profile' => Auth::user()]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
