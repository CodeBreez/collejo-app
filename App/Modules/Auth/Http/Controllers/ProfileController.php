<?php

namespace Collejo\App\Modules\Auth\Http\Controllers;

use Collejo\App\Http\Controller;
use Auth;

class ProfileController extends Controller
{
    /**
     * Returns the view for the profile.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfile()
    {
        return redirect(route('user.details.view', Auth::user()->id));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
