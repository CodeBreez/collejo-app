<?php 

namespace Collejo\Core\Foundation;

use Illuminate\Foundation\Application as BaseApplication;

class Application extends BaseApplication {

	const VERSION = '1.0.0';

	public function isInstalled()
	{
		return false;
	}
}