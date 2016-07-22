<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\User;

class StudentCategory extends Model
{

    protected $table = 'student_categories';

    protected $fillable = ['name'];

    public function students()
    {
    	return $this->hasMany(User::class);
    }

}
