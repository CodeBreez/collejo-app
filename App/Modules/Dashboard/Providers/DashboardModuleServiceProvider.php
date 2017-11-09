<?php

namespace Collejo\App\Modules\Dashboard\Providers;

use Collejo\App\Modules\BaseModuleServiceProvider as ModuleServiceProvider;
use View;

class DashboardModuleServiceProvider extends ModuleServiceProvider
{

	public function register()
	{
		View::composer(
			'layouts.dash', 'Collejo\App\Modules\Dashboard\Http\ViewComposers\DashComposer'
		);
	}
}
