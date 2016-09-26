<?php

namespace Collejo\App\Models;

use Collejo\App\Database\Eloquent\Model;
use Collejo\App\Models\Clasis;
use Collejo\App\Models\Batch;

class Grade extends Model
{

    protected $table = 'grades';

    protected $fillable = ['name'];

    public function classes()
    {
    	return $this->hasMany(Clasis::class);
    }

    public function batches()
    {
    	return $this->belongsToMany(Batch::class);
    }
}
