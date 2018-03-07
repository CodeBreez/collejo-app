<?php

namespace Collejo\App\Foundation\Widget;

use Collejo\App\Contracts\Widget\WidgetServiceProvider as WidgetServiceProviderContract;
use Illuminate\Support\ServiceProvider;
use Widget;

abstract class WidgetServiceProvider extends ServiceProvider implements WidgetServiceProviderContract
{
    protected $widgets = [];

    public function initWidgets()
    {
        foreach ($this->widgets as $class) {
            Widget::add(new $class());
        }
    }
}
