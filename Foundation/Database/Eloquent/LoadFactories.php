<?php

namespace Collejo\Foundation\Database\Eloquent;

use Illuminate\Database\Eloquent\Factory;

trait LoadFactories
{
    public $eloquentFactory;

    public function loadFactories()
    {
        $this->eloquentFactory = app()->make(Factory::class);

        $modules = app()->make('modules');

        foreach ($modules->getModulePaths() as $path) {
            if (file_exists($path)) {
                foreach (listDir($path) as $dir) {
                    if (is_dir($path.'/'.$dir)) {
                        $factoriesDir = realpath($path.'/'.$dir.'/Models/factories');
                        if (file_exists($factoriesDir)) {
                            $this->eloquentFactory->load($factoriesDir);
                        }
                    }
                }
            }
        }
    }
}
