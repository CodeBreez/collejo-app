<?php

namespace Collejo\App\Modules\Auth\Http\Controllers;

use Collejo\App\Http\Controller;
use Auth;

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
