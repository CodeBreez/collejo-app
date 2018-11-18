<?php

namespace Collejo\App\Modules\Students\Models;

use Collejo\App\Modules\ACL\Models\Traits\CommonUserPropertiesTrait;
use Collejo\App\Modules\Classes\Models\Batch;
use Collejo\App\Modules\Classes\Models\Clasis;
use Collejo\App\Modules\Media\Models\Media;
use Collejo\Foundation\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Student extends Model
{
    use SoftDeletes, CommonUserPropertiesTrait;

    protected $table = 'students';

    protected $fillable = ['admission_number', 'admitted_on', 'image_id'];

    protected $dates = ['admitted_on'];

    protected $appends = ['class', 'grade', 'batch', 'first_name', 'last_name', 'date_of_birth', 'email'];

    /**
     * Returns a collection of Guardians connections to this Student.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, 'guardian_student', 'student_id', 'guardian_id');
    }

    /**
     * Category of this Student.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function studentCategory()
    {
        return $this->hasOne(StudentCategory::class);
    }

    /**
     * Returns the list of classes the Student was assigned to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function classes()
    {
        return $this->belongsToMany(Clasis::class, 'class_student', 'student_id', 'class_id')
                    ->withPivot('created_at', 'batch_id')
                    ->orderBy('pivot_created_at', 'desc');
    }

    /**
     * Returns the current class for this student.
     *
     * @return mixed
     */
    private function currentClassRow()
    {
        return DB::table('class_student')->where('student_id', $this->id)->orderBy('created_at', 'DESC')->first();
    }

    /**
     * Returns the Class.
     *
     * @return mixed
     */
    public function getClassAttribute()
    {
        if ($row = $this->currentClassRow()) {
            return Clasis::findOrFail($row->class_id);
        }
    }

    /**
     * Returns the Batch.
     *
     * @return mixed
     */
    public function getBatchAttribute()
    {
        if ($row = $this->currentClassRow()) {
            return Batch::findOrFail($row->batch_id);
        }
    }

    /**
     * Returns the Grade.
     *
     * @return mixed
     */
    public function getGradeAttribute()
    {
        if ($class = $this->class) {
            return $class->grade;
        }
    }

    /**
     * Returns the picture of the Student.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function picture()
    {
        return $this->hasOne(Media::class, 'id', 'image_id');
    }
}
