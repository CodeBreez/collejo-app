<?php 

namespace Collejo\App\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Gate;
use Auth;

class DashController extends BaseController
{

	public function getIndex()
	{
		//event(new \Collejo\App\Events\UserPermissionsChanged(Auth::user()));
		return view('collejo::dash.dash')->render();
	}
}
