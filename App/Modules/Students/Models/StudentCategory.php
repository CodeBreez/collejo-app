<?php

namespace Collejo\App\Modules\Students\Models;

use Collejo\Foundation\Database\Eloquent\Model;

class StudentCategory extends Model
{
    protected $table = 'student_categories';

    protected $fillable = ['name', 'code'];

    /**
     * Returns a collection of Students belonging to this Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
