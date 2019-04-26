<?php

namespace Collejo\App\Modules\Auth\Http\Controllers;

use Auth;
use Collejo\App\Http\Controller;

class ProfileController extends Controller
{
    /**
     * Returns the view for the profile.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfile()
    {
        return view('auth::view_profile_details', [
            'user' => Auth::user(),
        ]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
