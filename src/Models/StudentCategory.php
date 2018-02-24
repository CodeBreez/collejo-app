<?php

namespace Collejo\App\Models;

use Collejo\App\Database\Eloquent\Model;

class StudentCategory extends Model
{
    protected $table = 'student_categories';

    protected $fillable = ['name', 'code'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
