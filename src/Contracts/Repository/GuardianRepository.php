<?php

namespace Collejo\App\Contracts\Repository;

interface GuardianRepository{

    public function createGuardian(array $attributes);

    public function updateGuardian(array $attributes, $guardianId);

    public function deleteAddress($addressId, $guardianId);

    public function updateAddress(array $attributes, $addressId, $guardianId);

    public function createAddress(array $attributes, $guardianId);

    public function findAddress($addressId, $guardianId);

    public function findGuardian($id);

    public function getGuardians($criteria);

    public function boot();

}