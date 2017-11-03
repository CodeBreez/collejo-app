<?php

namespace Collejo\Foundation\Menus;

/**
 * @file Menus.php
 * Description.
 *
 * @author Anuradha Jayathilaka <anuradha@collejo.com>
 * @copyright © 2017 CodeBreez, all rights reserved.
 * @version 1.0.0
 */

class Menus{

	public function getMenuBarItems()
	{
		return collect();
	}

	public function __construct($app){

		$this->app = $app;
	}
}