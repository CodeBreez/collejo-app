<?php

namespace Collejo\App\Modules\Employees\Models;

use Collejo\Foundation\Database\Eloquent\Model;

class EmployeePosition extends Model
{

    protected $table = 'employee_positions';

    protected $fillable = ['name', 'employee_category_id'];

    protected $with = ['employeeCategory'];

    public function employeeCategory()
    {
    	return $this->belongsTo(EmployeeCategory::class);
    }

    public function employees()
    {
    	return $this->hasManyThrough(EmployeeCategory::class, 'employeeCategory');
    }

}
