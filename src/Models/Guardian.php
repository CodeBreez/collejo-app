<?php

namespace Collejo\App\Models;

use Collejo\App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collejo\App\Traits\CommonUserPropertiesTrait;

class Guardian extends Model
{

    use SoftDeletes, CommonUserPropertiesTrait;

    protected $table = 'guardians';

    protected $fillable = ['user_id', 'ssn'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'guardian_student', 'guardian_id', 'student_id');
    }    
}
