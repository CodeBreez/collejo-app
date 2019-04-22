<?php

namespace Collejo\App\Modules\Employees\Models;

use Collejo\Foundation\Database\Eloquent\Model;

class EmployeeGrade extends Model
{

    protected $table = 'employee_grades';

    protected $fillable = ['name', 'code', 'priority', 'max_sessions_per_day', 'max_sessions_per_week'];

    public function employees()
    {
    	return $this->hasMany(Employee::class);
    }

}
