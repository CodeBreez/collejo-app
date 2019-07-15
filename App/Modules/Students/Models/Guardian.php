<?php

namespace Collejo\App\Modules\Students\Models;

use Collejo\App\Modules\ACL\Models\Traits\CommonUserPropertiesTrait;
use Collejo\Foundation\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
    use SoftDeletes, CommonUserPropertiesTrait;

    protected $table = 'guardians';

    protected $fillable = ['ssn'];

    protected $with = ['user'];

    /**
     * Returns a collection of Students for this Guardian.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'guardian_student', 'guardian_id', 'student_id');
    }
}
