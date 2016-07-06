<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\Term;

class Grade extends Model
{

    protected $table = 'grades';

    protected $fillable = ['name'];

}
