<?php

namespace Collejo\App\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Menu\Factory
 */
class Widget extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'widgets';
    }
}
