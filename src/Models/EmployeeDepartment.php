<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\Employee;

class EmployeeDepartment extends Model
{

    protected $table = 'employee_departments';

    protected $fillable = ['name', 'code'];

    public function employees()
    {
    	return $this->hasMany(Employee::class);
    }

}
