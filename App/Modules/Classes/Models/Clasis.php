<?php

namespace Collejo\App\Modules\Classes\Models;

use Collejo\Foundation\Database\Eloquent\Model;

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
