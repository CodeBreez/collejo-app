<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collejo\App\Models\User;
use Collejo\App\Models\Clasis;
use DB;

class Student extends Model
{
    
    use SoftDeletes;

    protected $table = 'students';

    protected $fillable = ['user_id', 'admission_number', 'admitted_on'];

    protected $dates = ['admitted_on'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function getNameAttribute()
    {
    	return $this->user->name;
    }    

    public function getFirstNameAttribute()
    {
    	return $this->user->first_name;
    }    

    public function getLastNameAttribute()
    {
    	return $this->user->last_name;
    }   

    public function getDateOfBirthAttribute()
    {
        return $this->user->date_of_birth;
    }    

    public function getEmailAttribute()
    {
    	return $this->user->email;
    }

    public function getAddressesAttribute()
    {
        return $this->user->addresses;
    }

    public function classes()
    {
        return $this->belongsToMany(Clasis::class, 'class_student', 'student_id', 'class_id');
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
}


