<?php

namespace Collejo\App\Modules\Students\Contracts;

interface GuardianRepository
{
    public function getGuardians($criteria);
}
