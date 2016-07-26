<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\EmployeeCategory;

class EmployeePosition extends Model
{

    protected $table = 'employee_positions';

    protected $fillable = ['employee_category_id', 'name', 'code'];

    public function employeeCategory()
    {
    	return $this->belongsTo(EmployeeCategory::class);
    }

    public function employees()
    {
    	return $this->hasManyThrough('employeeCategory');
    }

}