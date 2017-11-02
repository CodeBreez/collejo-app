<?php

namespace Collejo\App\Modules\Base\Commands;

use Illuminate\Console\Command;
use Illuminate\Routing\Router;

class BuildRoutesJs extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'asset:routes';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Build Routes JS';

	public function __construct(Router $router)
	{
		parent::__construct();

		$this->router = $router;
		$this->routes = $router->getRoutes();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$routes = [];

		foreach($this->routes as $route){

			if(in_array('GET',  $route->methods())){

				$routes[] = [
					'name' => $route->getName(),
					'uri' => $route->uri()
				];
			}
		}

		$handle = fopen(storage_path() . '/collejo/routes.json', 'w');

		fwrite($handle, json_encode($routes));

		fclose($handle);

		$this->info('routes.json updated!');
	}
}
