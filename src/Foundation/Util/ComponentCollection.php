<?php

namespace Collejo\App\Foundation\Util;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Collection;
use ReflectionClass;

abstract class ComponentCollection {

	protected $app;

	protected $items;

    public function scanDir($path)
    {
        return array_filter(scandir($path), function($item){
                    return !in_array($item, ['.', '..']) && substr($item, 0, 1) != '.';
                });
    }

    public function appModulesPath() {

        $reflection = new ReflectionClass('Collejo\App\Providers\ModuleServiceProvider');

        $pathinfo = pathinfo($reflection->getFileName());

        return realpath($pathinfo['dirname'] . '/../Modules');
    }

    public function getModulePaths()
    {
        return [
            'Collejo\Modules' => base_path('modules'),
            'Collejo\App\Modules' => $this->appModulesPath()
        ];
    }  

    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->items = new Collection();
    }  

    public function all()
    {
    	return $this->items;
    }

    public function add($item)
    {
        $this->items->push($item);
    }

    public function find($name)
    {
        return $this->items->where('name', $name)->first();
    }

    public function first()
    {
        return $this->items->first();
    }
}