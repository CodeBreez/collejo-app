<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\Student;
use Collejo\App\Models\Grade;

class Clasis extends Model
{

    protected $table = 'classes';

    protected $fillable = ['grade_id', 'name'];

    public function students()
    {
    	return $this->belongsToMany(Student::Class, 'class_student', 'id', 'student_id');
    }

    public function grade()
    {
    	return $this->belongsTo(Grade::class);
    }
}
