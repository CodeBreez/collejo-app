<?php

namespace Collejo\Core\Foundation;

use Collejo\Core\Foundation\Setup\Report;
use Collejo\Core\Foundation\Setup\Checkup\CheckEnvFile;
use Collejo\Core\Foundation\Setup\Checkup\CheckModulesDir;
use Collejo\Core\Foundation\Setup\Checkup\CheckDB;
use Artisan;
use DirectoryIterator;
use Collejo\Repository\UserRepository;

class Setup {

	private $params;
	private $step;
	private $param1;
	private $param2;
	private $revManifest = [];

	public function processStep($step, $param1, $param2)
	{
		$this->step = $step;
		$this->param1 = $param1;
		$this->param2 = $param2;

		switch ($this->step) {
			case 'env':

				if ($param1 == 'create') {
					$this->updateEnv();
				}

				break;

			case 'migrate':

				if ($this->param1 == 'copy') {
					$this->copyMigrations();
				} elseif ($this->param1 = 'run') {
					$this->runMigrations();
				}

				break;

			case 'asset':

				if ($this->param1 == 'copy') {
					$this->copyAssets();
				}

			case 'admin':

				if ($this->param1 == 'create') {
					$this->createAdmin();
				}
		}

		return [
			'status' => trans('collejo::setup.' . str_replace('/', '_', $this->getCurrentStepName() == '' ? 'installing' : $this->getCurrentStepName())),
			'progress' => $this->getProgress(),
			'next' => $this->getNextStepName()
		];
	}

	private function getProgress()
	{
		return 100 / count($this->getSetupSteps()) * $this->getCurrentStepId();
	}

	private function getNextStepName()
	{
		return isset($this->getSetupSteps()[$this->getNextStepId()]) ? $this->getSetupSteps()[$this->getNextStepId()] : false;
	}

	private function getNextStepId()
	{
		return $this->getCurrentStepId() + 1;
	}

	private function getCurrentStepId()
	{
		return array_search($this->getCurrentStepName(), $this->getSetupSteps());
	}

	private function getCurrentStepName()
	{
		$parts = array_filter([$this->step, $this->param1, $this->param2]);
		return implode('/', $parts);
	}

	public function createAdmin()
	{
		$this->userRepository->create([
				'first_name' => $this->params['admin_first_name'],
				'last_name' => $this->params['admin_last_name'],
				'email' => $this->params['admin_email'],
				'password' => $this->params['admin_password']
			]);
	}

	public function updateEnv()
	{
		$vars = $this->readEnv();

		$vars['DB_CONNECTION'] = 'mysql';
		$vars['DB_HOST'] = $this->params['db_host'];
		$vars['DB_PORT'] = $this->params['db_port'];
		$vars['DB_DATABASE'] = $this->params['db_database'];
		$vars['DB_USERNAME'] = $this->params['db_username'];
		$vars['DB_PASSWORD'] = $this->params['db_password'];

		$fp = fopen(base_path() . '/.env', 'wa+');

		foreach ($vars as $key => $value) {
			if ($value != '') {
				fwrite($fp, $key . '=' . $value . PHP_EOL);
			} else {
				fwrite($fp, PHP_EOL);
			}
			
		}
		
		fclose($fp);

	}

	public function readEnv()
	{
		$vars = [];
		$lines = file(base_path() . '/.env', FILE_IGNORE_NEW_LINES);
		
		foreach ($lines as $line) {
			$parts = explode('=', $line);
			$vars[$parts[0]] = isset($parts[1]) ? $parts[1] . '=' : '';
		}

		return $vars;
	}

	public function runMigrations()
	{
		Artisan::call('migrate');
		return Artisan::output();
	}

	public function copyMigrations()
	{
		$this->copyFilesInFoder(__DIR__ . '/../../migrations', base_path('database/migrations'));
	}

	public function copyAssets()
	{
		$this->copyFilesInFoder(__DIR__ . '/../../resources/assets/css', base_path('public/css'), true);
		$this->copyFilesInFoder(__DIR__ . '/../../resources/assets/js', base_path('public/js'), true);
		$this->copyFilesInFoder(__DIR__ . '/../../resources/assets/images', base_path('public/images'), true);

		$this->saveRevManifest();
	}

	private function saveRevManifest()
	{
		$fn = fopen(storage_path('rev-manifest.json'), 'w');

		fwrite($fn, json_encode($this->revManifest), JSON_PRETTY_PRINT);

		fclose($fn);
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

	public function getSetupSteps()
	{
		$steps = [
			'env/create',
			'migrate/copy',
			'migrate/run',
			'asset/copy',
			'admin/create'	
		];

		/*foreach ($$this->params['modules'] as $module) {
			$steps[] = 'module/download/' . $module;
			$steps[] = 'module/copy/' . $module;
			$steps[] = 'module/install/' . $module;
		}*/

		$steps[] = 'setup/done';

		return $steps;
	}

	private function copyFilesInFoder($from, $to, $versioned = false)
	{
		foreach (new DirectoryIterator($from) as $fileInfo) {
		    if($fileInfo->isDot()) continue;

		    if (!file_exists($to)) {
			    mkdir($to, 0755, true);
			} 

			array_map('unlink', glob($to . '/*'));

		    if ($versioned) {
		    	
		    	$revisionFileName = md5(time().$fileInfo->getFilename()) . '-' . $fileInfo->getFilename();
		    	
		    	$this->revManifest[basename($to) . '/' . $fileInfo->getFilename()] = basename($to) . '/' . $revisionFileName;

		    	copy($from . '/' . $fileInfo->getFilename(), $to . '/' . $revisionFileName);

		    } else {

		    	copy($from . '/' . $fileInfo->getFilename(), $to . '/' . $fileInfo->getFilename());
		    	
		    }

		}
	}

	public function setSetupData($params)
	{
		$this->params = $params;
		return $this;
	}

	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}
}