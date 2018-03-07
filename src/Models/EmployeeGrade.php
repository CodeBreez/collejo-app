<?php

namespace Collejo\App\Models;

use Collejo\App\Database\Eloquent\Model;

class EmployeeGrade extends Model
{
    protected $table = 'employee_grades';

    protected $fillable = ['name', 'code', 'priority', 'max_sessions_per_day', 'max_sessions_per_week'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
