<?php

namespace Collejo\App\Models;

use Collejo\App\Database\Eloquent\Model;
use Collejo\App\Traits\CommonUserPropertiesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
    use SoftDeletes, CommonUserPropertiesTrait;

    protected $table = 'guardians';

    protected $fillable = ['user_id', 'ssn'];

    protected $with = ['user'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'guardian_student', 'guardian_id', 'student_id');
    }
}
