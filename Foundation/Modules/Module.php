<?php

namespace Collejo\Foundation\Modules;

class Module
{
    /**
     * Returns an array of paths to load modules from.
     *
     * @return array
     */
    public function getModulePaths()
    {
        return array_merge([realpath(__DIR__.'/../../App/Modules')], array_map(function ($path) {
            return base_path($path);
        }, config('collejo.module_paths')));
    }

    /**
     * Load all modules from all paths.
     */
    public function loadModules()
    {
        foreach ($this->getModulePaths() as $path) {
            if (file_exists($path)) {
                foreach (listDir($path) as $dir) {
                    if (is_dir($path.'/'.$dir)) {
                        $this->registerModule($dir);
                    }
                }
            }
        }
    }

    /**
     * Registers a module using the provider.
     *
     * @param $dir
     *
     * @throws \Exception
     */
    private function registerModule($dir)
    {
        $provider = 'Collejo\App\Modules\\'.$dir.'\Providers\\'.$dir.'ModuleServiceProvider';

        if (!class_exists($provider)) {
            throw new \Exception($dir.'ModuleServiceProvider not found in module '.$dir);
        }

        app()->register($provider);
    }

    public function __construct($app)
    {
        $this->app = $app;
    }
}
