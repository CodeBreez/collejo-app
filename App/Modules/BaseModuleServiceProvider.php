<?php

namespace Collejo\App\Modules;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use ReflectionClass;

abstract class BaseModuleServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->initModule();
    }

	public function initModule()
	{

		$viewsDir = $this->getModuleDirectory('resources/views');
		$langDir = $this->getModuleDirectory('resources/lang');
        $migrationsDir = $this->getModuleDirectory('migrations');
        $routesFile = $this->getModuleDirectory('Http/routes.php');
		$menusFile = $this->getModuleDirectory('Http/menus.php');

		if (file_exists($viewsDir)) {

        	$this->loadViewsFrom($viewsDir, strtolower($this->getModuleName()));
		}

		if (file_exists($langDir)) {

	        $this->loadTranslationsFrom($langDir, strtolower($this->getModuleName()));
	    }

        if (file_exists($migrationsDir)) {

            $this->loadMigrationsFrom($migrationsDir);
        }

		if (file_exists($routesFile)) {

	        $this->app->router->group([
	            'namespace' => $this->getModuleNamespace(), 'middleware' => 'web',
	        ], function ($router) use ($routesFile) {

	            require $routesFile;
	        });
	    }

	    if (file_exists($menusFile)) {

	        require_once $menusFile;
	    }

	    $this->defineAbilities(app()->make(GateContract::class));
	}

	private function defineAbilities(GateContract $gate)
	{
		foreach ($this->getPermissions() as $permission => $childPermissions) {

			$this->defineAbility($gate, $permission);

	        foreach ($childPermissions as $permission) {

	        	$this->defineAbility($gate, $permission);
	        }
		}
	}

	private function defineAbility($gate, $permission)
	{
		$gates = $this->getGates();

		if (isset($gates[$permission])) {

			$closure = $gates[$permission];

		} else {

			$closure = (function($user) use ($permission) {

                return $user->hasPermission($permission);
            });
		}

		$gate->define($permission, $closure);
	}

	public function createPermissions()
	{
		if (is_array($this->getPermissions()) && $this->app->isInstalled()) {

			$userRepository = $this->app->make(userRepository::class);

			$adminRole = $userRepository->getRoleByName('admin');

			foreach ($this->getPermissions() as $permission => $childPermissions) {

				$permission = $userRepository->createPermissionIfNotExists($permission, strtolower($this->name));

				$userRepository->addPermissionToRole($adminRole, $permission);

				foreach ($childPermissions as $child) {

					$childPermission = $userRepository->createPermissionIfNotExists($child, strtolower($this->name));
					$permission->children()->save($childPermission);

					$userRepository->addPermissionToRole($adminRole, $childPermission);
				}

			}
		}
	}

	private function getModuleName()
	{
		return basename($this->getModuleDirectory());
	}

	private function getModuleNamespace()
	{
		return 'Collejo\App\Modules\\' . $this->getModuleName() . '\Http\Controllers';
	}

	private function getModuleDirectory($subDir = '')
	{
		$className = get_class($this);
		$reflector = new ReflectionClass($className);
		$file = $reflector->getFileName();
		$directory = dirname($file);

		return realpath($directory . '/../' . $subDir);
	}

	public function getPermissions()
	{
		return [];
	}

	public function getGates()
	{
		return [];
	}

	public function __construct($app)
	{
		parent::__construct($app);
		$this->name = basename($this->getModuleDirectory());
	}
}
