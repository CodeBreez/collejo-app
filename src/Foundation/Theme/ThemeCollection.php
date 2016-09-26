<?php 

namespace Collejo\App\Foundation\Theme;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Container\Container as Application;

class ThemeCollection extends Collection {

	public function getCurrent()
	{
		//return Route::getRoutes();

		//return Menu::getItems();
	}

	public function __construct(Application $app)
	{
		$this->app = $app;

		$this->menus = new Collection();
	}
}