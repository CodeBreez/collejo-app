<?php 

namespace Collejo\App\Contracts\Module;

use Illuminate\Routing\Router;

interface ModuleServiceProvider {

	public function initModule();

	public function getPermissions();
	
	public function getGates();
}