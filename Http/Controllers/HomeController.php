<?php 

namespace Collejo\App\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;

class HomeController extends BaseController
{

	public function getIndex()
	{
		return view('collejo::home')->render();
	}
}
