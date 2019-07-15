<?php

namespace Collejo\App\Modules\ACL\Models\Traits;

use Collejo\App\Modules\ACL\Models\User;

trait CommonUserPropertiesTrait
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNameAttribute()
    {
        return $this->user->name;
    }

    public function getFirstNameAttribute()
    {
        return $this->user->first_name;
    }

    public function getLastNameAttribute()
    {
        return $this->user->last_name;
    }

    public function getDateOfBirthAttribute()
    {
        return $this->user->date_of_birth;
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    public function getAddressesAttribute()
    {
        return $this->user->addresses;
    }
}
