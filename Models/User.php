<?php

namespace Collejo\App\Models;

use Collejo\Core\Foundation\Auth\User as Authenticatable;
use Collejo\App\Models\Role;
use Collejo\App\Models\Student;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function roles()
    {
    	return $this->belongsToMany(Role::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
