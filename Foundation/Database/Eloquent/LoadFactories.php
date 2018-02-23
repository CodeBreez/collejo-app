<?php

namespace Collejo\Foundation\Database\Eloquent;

use Illuminate\Database\Eloquent\Factory;

trait LoadFactories
{
    public $eloquentFactory;

    public function loadFactories()
    {
        $this->eloquentFactory = app()->make(Factory::class);

        $factoriesDir = realpath(dirname((new \ReflectionClass(static::class))->getFileName()).'/../../Models/factories');

        if (file_exists($factoriesDir)) {
            $this->eloquentFactory->load($factoriesDir);
        }
    }
}
