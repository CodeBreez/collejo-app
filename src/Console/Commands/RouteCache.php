<?php

namespace Collejo\App\Console\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\RouteCollection;
use Illuminate\Foundation\Console\RouteCacheCommand;

class RouteCache extends RouteCacheCommand
{

    /**
     * Boot a fresh copy of the application and get the routes.
     *
     * @return \Illuminate\Routing\RouteCollection
     */
    protected function getFreshApplicationRoutes()
    {
        $app = require $this->laravel->bootstrapPath().'/app.php';

        $app->make('Collejo\App\Contracts\Console\Kernel')->bootstrap();

        return $app['router']->getRoutes();
    }
}
