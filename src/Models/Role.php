<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\User;
use Collejo\App\Models\Permission;

class Role extends Model
{

    protected $table = 'roles';

    protected $fillable = ['role'];

    public function getNameAttribute()
    {
        return str_replace('_', ' ', ucfirst($this->role));
    }

    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
    	return $this->belongsToMany(Permission::class);
    }
}
