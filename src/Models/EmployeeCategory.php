<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\Employee;
use Collejo\App\Models\EmployeePosition;

class EmployeeCategory extends Model
{

    protected $table = 'employee_categories';

    protected $fillable = ['name', 'code'];

    public function employees()
    {
    	return $this->hasMany(Employee::class);
    }

    public function employeePositions()
    {
    	return $this->hasMany(EmployeePosition::class);
    }
}
