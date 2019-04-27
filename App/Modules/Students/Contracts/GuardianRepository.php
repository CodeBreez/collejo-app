<?php

namespace Collejo\App\Modules\Students\Contracts;

interface GuardianRepository
{
    public function createGuardian(array $attributes);

    public function updateGuardian(array $attributes, $guardianId);

    public function findGuardian($id);

    public function getGuardians($criteria);


}
