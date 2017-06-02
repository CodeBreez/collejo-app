<?php

namespace Collejo\App\Models;

use Collejo\App\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;
    
    protected $table = 'subjects';

    protected $fillable = ['name', 'code', 'parent_id', 'created_by', 'updated_by'];

}
