<?php

/**
 * Copyright (C) 2017 Anuradha Jauayathilaka <astroanu2004@gmail.com>.
 */

namespace Collejo\App\Contracts\Module;

/**
 * Interface ModuleServiceProvider.
 */
interface ModuleServiceProvider
{
    /**
     * Initializes the module.
     *
     * @return null
     */
    public function initModule();

    /**
     * Returns a list of permissions for the module.
     *
     * @return array
     */
    public function getPermissions();

    /**
     * Returns a list of gates requires for authorisation.
     *
     * @return array
     */
    public function getGates();
}
