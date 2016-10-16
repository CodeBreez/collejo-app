<?php

namespace Collejo\App\Modules\ACL\Providers;

use Collejo\App\Foundation\Widget\WidgetServiceProvider as BaseWidgetServiceProvider;
use Collejo\App\Modules\ACL\Widgets\UserStatus;

class ACLWidgetServiceProvider extends BaseWidgetServiceProvider
{
	protected $widgets = [
		UserStatus::class
	];

    public function boot()
    {
        $this->initWidgets();
    }

	public function register()
    {

    }
}
