<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use use Collejo\App\Models\Role;

class Permission extends Model
{
    protected $table = 'users';

    protected $fillable = ['permission', 'description'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
