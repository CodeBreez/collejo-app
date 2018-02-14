<?php

namespace Collejo\App\Models;

use Collejo\App\Database\Eloquent\Model;

class EmployeeDepartment extends Model
{
    protected $table = 'employee_departments';

    protected $fillable = ['name', 'code'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
