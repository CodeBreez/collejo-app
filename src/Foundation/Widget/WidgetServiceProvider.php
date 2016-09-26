<?php

namespace Collejo\App\Foundation\Widget;

use Illuminate\Support\ServiceProvider;
use Collejo\App\Contracts\Widget\WidgetServiceProvider as WidgetServiceProviderContract;
use Illuminate\Routing\Router;
use ReflectionClass;
use Collejo\App\Contracts\Repository\UserRepository;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Widget;

abstract class WidgetServiceProvider extends ServiceProvider implements WidgetServiceProviderContract
{
	protected $widgets = [];
	
	public function initWidgets()
	{
		foreach ($this->widgets as $class) {
			Widget::add(new $class);
		}
	}
}
