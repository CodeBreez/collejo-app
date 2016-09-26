<?php 

namespace Collejo\App\Foundation\Module;

use Illuminate\Container\Container as Application;
use Collejo\App\Foundation\Util\ComponentCollection;
use Collejo\App\Contracts\Module\Module as ModuleInterface;
use ReflectionClass;
use Module;

class ModuleCollection extends ComponentCollection {

    public function loadModules()
    {
        foreach ($this->getModulePaths() as $moduleLocation => $path) {

            if (file_exists($path)) {

                foreach ($this->scandir($path) as $dir) {
                    $module = $this->registerModule($moduleLocation, $dir, $path . '/' . $dir);
                }

            }
        }
    }

    public function registerModule($moduleLocation, $namespace, $path)
    {
        $provider = $moduleLocation . '\\' . $namespace . '\Providers\\' . $namespace . 'ModuleServiceProvider';

        if (!class_exists($provider)) {
            return false;
        }

        $this->app->register($provider);

        $module = $this->app->make(ModuleInterface::class);

        $module->name = strtolower($namespace);
        $module->displayName = $namespace;
        $module->provider = $provider;
        $module->path = $path . '/' . $namespace;

        Module::add($module);
        
        return $module;
    }

}