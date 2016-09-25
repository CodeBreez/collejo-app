<?php 

namespace Collejo\App\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Gate;
use Auth;

class DashController extends BaseController
{

	public function getIndex()
	{

		/*$permission = \Collejo\App\Models\Permission::where('permission', 'disable_role')->first();

		$permission->children()->save(\Collejo\App\Models\Permission::where('permission', 'add_remove_permission_to_role')->first());

		dd($permission->children);*/


		//event(new \Collejo\App\Events\UserPermissionsChanged(Auth::user()));
		return view('collejo::dash.dash')->render();
	}
}
