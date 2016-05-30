<?php 

namespace Collejo\Core\Foundation;

use Illuminate\Foundation\Application as BaseApplication;
use DB;

class Application extends BaseApplication {

	const VERSION = '1.0.0';

	public function isInstalled()
	{
		try {

			return (bool) DB::connection('mysql')->select('SHOW TABLES');

		} catch (\Exception $e) {

			return false;

		}
	}
}