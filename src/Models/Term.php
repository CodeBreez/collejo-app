<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Term extends Model
{

    use SoftDeletes;

    protected $table = 'terms';

    protected $fillable = ['batch_id', 'name', 'start_date', 'end_date', 'created_by', 'updated_by'];

    protected $dates = ['start_date', 'end_date'];

}
