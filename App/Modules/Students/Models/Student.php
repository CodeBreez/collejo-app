<?php

namespace Collejo\App\Modules\Students\Models;

use Collejo\App\Modules\ACL\Models\Traits\CommonUserPropertiesTrait;
use Collejo\Foundation\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Student extends Model
{

    use SoftDeletes, CommonUserPropertiesTrait;

    protected $table = 'students';

    protected $fillable = ['admission_number', 'admitted_on', 'student_category_id', 'image_id'];

    protected $dates = ['admitted_on'];

    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, 'guardian_student', 'student_id', 'guardian_id');
    }

    public function studentCategory()
    {
        return $this->hasOne(StudentCategory::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Clasis::class, 'class_student', 'student_id', 'class_id')
                    ->withPivot('created_at', 'batch_id')
                    ->orderBy('pivot_created_at', 'desc');
    }

    private function currentClassRow()
    {
        return DB::table('class_student')->where('student_id', $this->id)->orderBy('created_at', 'DESC')->first();
    }

    public function getClassAttribute()
    {
        if ($row = $this->currentClassRow()) {
            return Clasis::findOrFail($row->class_id);
        }
    }

    public function getBatchAttribute()
    {
        if ($row = $this->currentClassRow()) {
            return Batch::findOrFail($row->batch_id);
        }
    }

    public function getGradeAttribute()
    {
        if ($class = $this->class) {
            return $class->grade;
        }
    }

    public function picture()
    {
        return $this->hasOne(Media::class, 'id', 'image_id');
    }
}

