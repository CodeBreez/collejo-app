<?php 

namespace Collejo\Http\Controllers;

use Collejo\Http\Controllers\Controller as BaseController;

class HomeController extends BaseController
{

	public function index()
	{
		return view('collejo::home')->render();
	}
}
