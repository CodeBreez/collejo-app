<?php

namespace Collejo\Core\Foundation;

use Collejo\Core\Foundation\Setup\Report;
use Collejo\Core\Foundation\Setup\Checkup\CheckEnvFile;
use Collejo\Core\Foundation\Setup\Checkup\CheckModulesDir;
use Collejo\Core\Foundation\Setup\Checkup\CheckDB;
use Artisan;

class Setup {

	public function copyMigrations()
	{
		//Artisan::call('migrate');
		//return Artisan::output();
	}

	public function preCheckup()
	{
		$checkups = new Report([
				new CheckEnvFile(),
				new CheckModulesDir(),
				new CheckDB()
			]);

		$params = $this->params;

		return $checkups->each(function($item) use ($params) {
			return $item->run($params)->getReport();
		});
	}

	public function __construct($params)
	{
		$this->params = $params;
	}
}