<?php

/**
 * Copyright (C) 2017 Anuradha Jauayathilaka <astroanu2004@gmail.com>.
 */
namespace Collejo\App\Console\Commands;

use Illuminate\Foundation\Console\ConfigCacheCommand;

/**
 * Class ConfigCache.
 */
class ConfigCache extends ConfigCacheCommand
{
    /**
     * Boot a fresh copy of the application configuration.
     *
     * @return array
     */
    protected function getFreshConfiguration()
    {
        $app = require $this->laravel->bootstrapPath().'/app.php';

        $app->make('Collejo\App\Contracts\Console\Kernel')->bootstrap();

        return $app['config']->all();
    }
}
