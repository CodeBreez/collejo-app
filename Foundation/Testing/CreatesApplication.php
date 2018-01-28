<?php

namespace Collejo\Foundation\Tests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
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

            $files = $this->scanDir(__DIR__ . $path);

            if(in_array('bootstrap', $files)){

                return __DIR__ . $path;
            }

            $path = $path  . '/..';
        }
    }

    /**
     * Scans a directory
     *
     * @param $path
     * @return array
     */
    public function scanDir($path)
    {
        return array_filter(scandir($path), function($item) {

            return !in_array($item, ['.', '..']) && substr($item, 0, 1) != '.';
        });
    }
}