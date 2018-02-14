<?php

namespace Collejo\App\Modules\Classes\Models;

use Collejo\Foundation\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Term extends Model
{
    use SoftDeletes;

    protected $table = 'terms';

    protected $fillable = ['batch_id', 'name', 'start_date', 'end_date'];

    protected $dates = ['start_date', 'end_date'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
