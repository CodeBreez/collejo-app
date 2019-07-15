<?php

namespace Collejo\App\Modules\Employees\Models;

use Collejo\Foundation\Database\Eloquent\Model;

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
