<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\Term;

class Batch extends Model
{

    protected $table = 'batches';

    protected $fillable = ['name', 'is_ended'];

    public function terms()
    {
    	return $this->hasMany(Term::class);
    }
}
