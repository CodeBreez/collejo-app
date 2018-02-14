<?php

namespace Collejo\App\Contracts\Module;

interface ModuleServiceProvider
{
    public function initModule();

    public function getPermissions();

    public function getGates();
}
