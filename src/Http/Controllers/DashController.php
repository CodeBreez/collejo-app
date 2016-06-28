<?php 

namespace Collejo\App\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;

class DashController extends BaseController
{

	public function getIndex()
	{
		return view('collejo::dash.home')->render();
	}
}
