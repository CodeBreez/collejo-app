<?php

namespace Collejo\Foundation\Console;

/**
 * @file Application.php
 * Description.
 *
 * @author Anuradha Jayathilaka <anuradha@collejo.com>
 * @copyright © 2017 CodeBreez, all rights reserved.
 * @version 1.0.0
 */

use Illuminate\Foundation\Console\Kernel as IlluminateConsoleKernel;
use Illuminate\Console\Application as Artisan;
use Symfony\Component\Finder\Finder;

class Kernel extends IlluminateConsoleKernel
{

	/**
	 * Register all of the commands in the given directory.
	 *
	 * @param  array|string  $paths
	 * @return void
	 */
	protected function load($paths)
	{
		$paths = array_unique(is_array($paths) ? $paths : (array) $paths);

		$paths = array_filter($paths, function ($path) {
			return is_dir($path);
		});

		if (empty($paths)) {
			return;
		}

		foreach ((new Finder)->in($paths)->files() as $command) {

			$command = str_replace(
				['/', '.php'],
				['\\', ''],
				$command->getPathname()
			);

			$command = substr($command, strpos($command, 'Collejo\App\Modules'));

			Artisan::starting(function ($artisan) use ($command) {

				$artisan->resolve($command);
			});
		}
	}
}