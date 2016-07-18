<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collejo\App\Traits\CommonUserPropertiesTrait;
use Collejo\App\Models\User;
use Collejo\App\Models\Clasis;
use DB;

class Employee extends Model
{
    
    use SoftDeletes, CommonUserPropertiesTrait;

    protected $table = 'employees';

    protected $fillable = ['user_id', 'employee_number', 'joined_on'];

    protected $dates = ['joined_on'];

}