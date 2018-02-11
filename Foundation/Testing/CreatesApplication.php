<?php

namespace Collejo\Foundation\Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Hash;

trait CreatesApplication
{

	protected $factory;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require $this->getAppPath() . '/bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        Hash::setRounds(4);

        return $app;
    }

    /**
     * Search for the bootstrap folder in reverse
     *
     * @return string
     */
    private function getAppPath()
    {
        $path = '/..';

        while(true){

            $files = listDir(__DIR__ . $path);

            if(in_array('bootstrap', $files)){

                return __DIR__ . $path;
            }

            $path = $path  . '/..';
        }
    }
}