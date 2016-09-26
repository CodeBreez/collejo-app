<?php

namespace Collejo\App\Models;

use Collejo\App\Database\Eloquent\Model;
use Collejo\App\Models\Role;

class Permission extends Model
{

    protected $table = 'permissions';

    protected $fillable = ['permission', 'module'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function children()
    {
    	return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
    	return $this->hasOne(self::class, 'id', 'parent_id');
    }   

    public function getNameAttribute()
    {
        return str_replace('_', ' ', ucfirst($this->permission));
    }
}
