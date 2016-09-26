<?php

namespace Collejo\App\Console\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\ConfigCacheCommand;

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
