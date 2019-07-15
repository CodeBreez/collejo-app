<?php

namespace Collejo\App\Modules\Employees\Models;

use Collejo\App\Modules\ACL\Models\Traits\CommonUserPropertiesTrait;
use Collejo\App\Modules\Media\Models\Media;
use Collejo\Foundation\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes, CommonUserPropertiesTrait;

    protected $table = 'employees';

    protected $fillable = [
        'employee_number',
        'joined_on',
        'employee_position_id',
        'employee_department_id',
        'employee_grade_id',
        'image_id',
    ];

    protected $dates = ['joined_on'];

    protected $with = ['user'];

    public function employeeDepartment()
    {
        return $this->belongsTo(EmployeeDepartment::class);
    }

    public function employeePosition()
    {
        return $this->belongsTo(EmployeePosition::class);
    }

    public function employeeGrade()
    {
        return $this->belongsTo(EmployeeGrade::class);
    }

    public function picture()
    {
        return $this->hasOne(Media::class, 'id', 'image_id');
    }
}
