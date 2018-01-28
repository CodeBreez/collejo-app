<?php

namespace Collejo\Foundation;

require_once ('helpers.php');

/**
 * @file Application.php
 * Description.
 *
 * @author Anuradha Jayathilaka <anuradha@collejo.com>
 * @copyright © 2017 CodeBreez, all rights reserved.
 * @version 1.0.0
 */

use Illuminate\Foundation\Application as IlluminateApplication;
use DB;

class Application extends IlluminateApplication
{

    const VERSION = '2.0.0';

    public $majorUserRoles = ['admin', 'student', 'employee', 'guardian'];

    /**
     * Determines whether the application is installed
     *
     * @return bool
     */
    public function isInstalled()
    {
        try {
            return (bool) DB::select('select migration from migrations');

        } catch (\Exception $e) {

            return false;

        }
    }
    /**
     * Returns the application namespace
     *
     * @return string
     */
	public function getNamespace()
	{
		return $this->namespace = 'Collejo\App';
	}
}