<?php 

namespace Collejo\App\Foundation\Widget;

use Illuminate\Container\Container as Application;
use Collejo\App\Foundation\Util\ComponentCollection;
use Collejo\App\Contracts\Widget\Widget as WidgetInterface;
use ReflectionClass;
use Widget;

class WidgetCollection extends ComponentCollection {

    public function loadWidgets()
    {
        foreach ($this->getModulePaths() as $moduleLocation => $path) {

            if (file_exists($path)) {

                foreach ($this->scandir($path) as $dir) {
                    $widget = $this->registerWidget($moduleLocation, $dir, $path . '/' . $dir);
                }

            }
        }        
    }

    public function registerWidget($moduleLocation, $namespace, $path)
    {
        $provider = $moduleLocation . '\\' . $namespace . '\Providers\\' . $namespace . 'WidgetServiceProvider';

        if (!class_exists($provider)) {
            return false;
        }

        $this->app->register($provider);
    }

    public function getByLocation($location)
    {
        return $this->all()->where('location', $location);
    }

    public function renderByLocation($location)
    {
        foreach ($this->getByLocation($location) as $widget) {
            echo view($widget->view);
        }
    }
}