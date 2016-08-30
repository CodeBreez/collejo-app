<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{

    use SoftDeletes;

    protected $table = 'guardians';

    protected $fillable = ['user_id', 'ssn'];
}
