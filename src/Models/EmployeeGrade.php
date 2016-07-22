<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\EmployeeCategory;

class EmployeeGrade extends Model
{

    protected $table = 'employee_grades';

    protected $fillable = ['name', 'code', 'priority', 'max_sessions_per_day', 'max_sessions_per_week'];

    public function employees()
    {
    	return $this->hasMany(Employee::class);
    }

}
