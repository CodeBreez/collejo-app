<?php

namespace Collejo\Foundation;

/**
 * @file Application.php
 * Description.
 *
 * @author Anuradha Jayathilaka <anuradha@collejo.com>
 * @copyright © 2017 CodeBreez, all rights reserved.
 * @version 1.0.0
 */

use Illuminate\Foundation\Application as IlluminateApplication;

class Application extends IlluminateApplication
{

	public function getNamespace()
	{
		return $this->namespace = 'Collejo\App';
	}
}