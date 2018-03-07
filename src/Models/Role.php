<?php

namespace Collejo\App\Models;

use Collejo\App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

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
