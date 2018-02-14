<?php

namespace Collejo\Foundation\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Menus extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'menus';
    }
}
