<?php

namespace Collejo\Foundation\Testing;

require_once __DIR__.'/../helpers.php';

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
        $app = require $this->getAppPath().'/bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        Hash::driver('bcrypt')->setRounds(4);

        return $app;
    }

    /**
     * Search for the bootstrap folder in reverse.
     *
     * @return string
     */
    private function getAppPath()
    {
        $path = '/..';

        while (true) {
            $files = listDir(__DIR__.$path);

            if (in_array('bootstrap', $files)) {
                return __DIR__.$path;
            }

            $path = $path.'/..';
        }
    }
}
