<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collejo\App\Traits\CommonUserPropertiesTrait;
use Collejo\App\Models\EmployeeCategory;
use Collejo\App\Models\employeeDepartment;
use Collejo\App\Models\employeePosition;
use Collejo\App\Models\employeeGrade;
use DB;

class Employee extends Model
{
    
    use SoftDeletes, CommonUserPropertiesTrait;

    protected $table = 'employees';

    protected $fillable = ['user_id', 'employee_number', 'joined_on', 'employee_position_id', 'employee_department_id', 'employee_grade_id', 'image_id'];

    protected $dates = ['joined_on'];

    public function employeeCategory()
    {
    	return $this->hasOne(EmployeeCategory::class);
    }

    public function employeeDepartment()
    {
    	return $this->hasOne(EmployeeDepartment::class);
    }

    public function employeePosition()
    {
    	return $this->hasOne(EmployeePosition::class);
    }

    public function employeeGrade()
    {
    	return $this->hasOne(EmployeeGrade::class);
    }

    public function picture()
    {
        return $this->hasOne(Media::class, 'id', 'image_id');
    }
}