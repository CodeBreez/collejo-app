<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;

class Clasis extends Model
{

    protected $table = 'classes';

    protected $fillable = ['grade_id', 'name'];

}
