<?php

namespace Collejo\App\Modules\Students\Providers;

use Collejo\Core\Foundation\Widget\WidgetServiceProvider as BaseWidgetServiceProvider;
use Collejo\App\Modules\Students\Widgets\GuardianStudents;

class StudentsWidgetServiceProvider extends BaseWidgetServiceProvider
{
	protected $widgets = [
		GuardianStudents::class
	];

    public function boot()
    {
        $this->initWidgets();
    }

	public function register()
    {

    }
}
