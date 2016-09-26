<?php 

namespace Collejo\App\Foundation\Theme;

use Illuminate\Database\Eloquent\Collection;
use Collejo\App\Contracts\Theme\Menu as MenuInterface;
use Illuminate\Container\Container as Application;
use Route;
use Menu;

class MenuCollection {

	protected $app;

	private $menus;

	public function getMenuBarItems()
	{
		$namedRoutes = $this->getNamedRoutes();

		foreach ($this->getItems() as $key => $menu) {
			if (isset($namedRoutes[$menu->getName()])) {
				$this->getItems()[$key]->setPath($namedRoutes[$menu->getName()]);
			}
		}

		$groups = $this->getItems()->where('type', 'g');

		$menus = $this->getItems()->where('type', 'm');

		$subGroups = $this->getItems()->where('type', 's');

		foreach ($subGroups as $subGroupItem) {
			$subGroupItem->children = $menus->where('parent', $subGroupItem->getName());
		}

		foreach ($groups as $groupsItem) {
			$groupsItem->children = $menus->where('parent', $groupsItem->getName())->union($subGroups->where('parent', $groupsItem->getName()));
		}

		return $groups;
	}

	private function getNamedRoutes()
	{
		$routeCollection = Route::getRoutes();
		$namedRoutes = [];

		foreach ($routeCollection as $route) {
			if (!is_null($route->getName())) {
				$namedRoutes[$route->getName()] = $route->getPath();
			}
		}

		return $namedRoutes;
	}

	public function getItems()
	{
		return $this->menus;
	}

	public function addNamespace($namespace, $path)
	{
		require_once ($path);
	}

	public function group()
	{
		if (func_num_args() == 3) {

			$label = func_get_arg(0);
			$icon = func_get_arg(1);
			$closure = func_get_arg(2);

			$menu = $this->app->make(MenuInterface::class);

			$name = strtolower($label);

			$menu->setName($name)->setLabel($label)->setIcon($icon)->setType('g');

			$this->menus->push($menu);

			$closure($name);

			return $menu;

		} elseif(func_num_args() == 1) {

			$closure = func_get_arg(0);

			$menu = $this->app->make(MenuInterface::class);

			$name = microtime(true);

			$menu->setName($name)->setLabel(null)->setType('s');

			$this->menus->push($menu);

			$closure($name);

			return $menu;
		}

		throw new \Exception('Invalid Arguments');
		
	}

	public function create($name, $label)
	{
		$menu = $this->app->make(MenuInterface::class);

		$menu->setName($name)->setLabel($label)->setType('m');

		$this->menus->push($menu);

		return $menu;
	}

	public function __construct(Application $app)
	{
		$this->app = $app;

		$this->menus = new Collection();
	}
}