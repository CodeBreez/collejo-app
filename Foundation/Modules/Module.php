<?php

namespace Collejo\Foundation\Modules;

use Illuminate\Support\Facades\Route;

class Module
{

    /**
     * Returns an array of paths to load modules from
     *
     * @return array
     */
	public function getModulePaths()
	{
		return array_merge([realpath(__DIR__ . '/../../App/Modules')], array_map(function($path){

			return base_path($path);

		}, config('collejo.module_paths')));
	}

    /**
     * Load all modules from all paths
     */
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

    /**
     * Registers a module using the provider
     *
     * @param $dir
     * @throws \Exception
     */
	private function registerModule($dir)
	{
		$provider = 'Collejo\App\Modules\\' . $dir . '\Providers\\' . $dir . 'ModuleServiceProvider';

		if (!class_exists($provider)) {

			throw new \Exception($dir . 'ModuleServiceProvider not found in module ' . $dir);
		}

		app()->register($provider);
	}

    /**
     * Scans a given directory
     *
     * @param $path
     * @return array
     */
	public function scanDir($path)
	{
		return array_filter(scandir($path), function($item) {

			return !in_array($item, ['.', '..']) && substr($item, 0, 1) != '.';
		});
	}

    /**
     * Get an array of language script files for the module
     *
     * @return array
     */
	public function getLangScriptFiles()
	{
		$files = [];

		if(config('app.locale') !== 'en'){

			$files[] = '/js/trans/' . $this->getModuleNameByPath() . '/en.js';
			$files[] = '/js/trans/base/en.js';
		}

		$files[] = '/js/trans/' . $this->getModuleNameByPath() . '/' . config('app.locale') . '.js';
		$files[] = '/js/trans/base/' . config('app.locale') . '.js';

		return array_filter($files, function($file){

            return file_exists(realpath(base_path() . '/public/' . $file));
		});
	}

    /**
     * Returns the module name by the given path
     *
     * @return string
     */
	public function getModuleNameByPath()
	{
		$router = app()->make('router');

		foreach($router->getRoutes() as $route){

			if ($route->getName() == Route::getFacadeRoot()->current()->getName()) {

				$parts = explode('\\', substr(get_class($route->controller), 20));

				return snake_case($parts[0]);
			}
		}
	}

	public function __construct($app){

		$this->app = $app;
	}
}