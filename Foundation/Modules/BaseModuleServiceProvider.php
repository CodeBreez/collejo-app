<?php

namespace Collejo\Foundation\Modules;

use Collejo\App\Modules\ACL\Contracts\UserRepository as UserRepositoryContract;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

abstract class BaseModuleServiceProvider extends ServiceProvider
{

    protected $name;

    /**
     * Boot up service provider
     */
    public function boot()
    {
        $this->initModule();

        if (config('collejo.tweak.check_module_permissions_on_module_init')) {

            $this->createPermissions();
        }
    }

    /**
     * Initializes the module
     */
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

    /**
     * Loop through module permissions and define them in the gate
     *
     * @param GateContract $gate
     */
	private function defineAbilities(GateContract $gate)
	{
		foreach ($this->getPermissions() as $permission => $childPermissions) {

			$this->defineAbility($gate, $permission);

	        foreach ($childPermissions as $permission) {

	        	$this->defineAbility($gate, $permission);
	        }
		}
	}

    /**
     * Defines a given ability in the gate for the current module
     *
     * If a corresponding gate closure was found it will use that
     * If no such closure if found will create a default closure
     *
     * @param $gate
     * @param $permission
     */
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

    /**
     * Create permissions in the database for the current module
     */
	public function createPermissions()
	{
		if (is_array($this->getPermissions()) && $this->app->isInstalled()) {

            $userRepository = $this->app->make(UserRepositoryContract::class);

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

    /**
     * Returns the current module name
     *
     * @return string
     */
	private function getModuleName()
	{
        return $this->name;
    }

    /**
     * Return the namespace for the current module
     *
     * @return string
     */
	private function getModuleNamespace()
	{
		return 'Collejo\App\Modules\\' . $this->getModuleName() . '\Http\Controllers';
	}

    /**
     * Returns the path to the current module
     *
     * @param string $subDir
     * @return bool|string
     */
	private function getModuleDirectory($subDir = '')
	{
		$className = get_class($this);
		$reflector = new ReflectionClass($className);

		$file = $reflector->getFileName();
		$directory = dirname($file);

		return realpath($directory . '/../' . $subDir);
	}

    /**
     * Returns an array of permissions for the current module
     *
     * @return array
     */
	public function getPermissions()
	{
		return [];
	}

    /**
     * Returns a list of gates for the current module
     *
     * @return array
     */
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
