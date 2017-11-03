<?php

namespace Collejo\Foundation\Modules;

use Illuminate\Support\Facades\Route;

/**
 * @file Modules.php
 * Description.
 *
 * @author Anuradha Jayathilaka <anuradha@collejo.com>
 * @copyright © 2017 CodeBreez, all rights reserved.
 * @version 1.0.0
 */

class Modules{

	public function getModulePaths()
	{
		return array_merge([realpath(__DIR__ . '/../../App/Modules')], array_map(function($path){

			return base_path($path);

		}, config('collejo.module_paths')));
	}


	public function loadModules()
	{
		foreach ($this->getModulePaths() as $path) {

			if (file_exists($path)) {

				foreach ($this->scandir($path) as $dir) {

					if(is_dir($path . '/' . $dir)){

						$this->registerModule($dir);
					}
				}
			}
		}
	}

	private function registerModule($dir)
	{
		$provider = 'Collejo\App\Modules\\' . $dir . '\Providers\\' . $dir . 'ModuleServiceProvider';

		if (!class_exists($provider)) {

			throw new \Exception($dir . 'ModuleServiceProvider not found in module ' . $dir);
		}

		app()->register($provider);
	}

	public function scanDir($path)
	{
		return array_filter(scandir($path), function($item) {

			return !in_array($item, ['.', '..']) && substr($item, 0, 1) != '.';
		});
	}

	public function getLangScriptFiles()
	{
		$files = [];

		if(config('app.locale') !== 'en'){

			$files[] = '/js/trans/' . $this->getModuleNameByPath() . '/en.js';

		}

		$files[] = '/js/trans/' . $this->getModuleNameByPath() . '/' . config('app.locale') . '.js';

		return $files;
	}

	public function getModuleNameByPath()
	{
		$router = app()->make('router');

		$route = Route::getFacadeRoot()->current();

		foreach($router->getRoutes() as $route){

			if ($route->getName() == Route::getFacadeRoot()->current()->getName()) {

				$parts = explode('\\', substr(get_class($route->controller), 20));

				return snake_case($parts[0]);
			}
		}

		return $currentPath = Route::getFacadeRoot()->current()->getName();
	}

	public function __construct($app){

		$this->app = $app;
	}
}