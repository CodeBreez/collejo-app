<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\Term;
use Collejo\App\Models\Grade;

class Batch extends Model
{

    protected $table = 'batches';

    protected $fillable = ['name'];

    public function terms()
    {
    	return $this->hasMany(Term::class);
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class);
    }

    public function scopeActive()
    {
        return $this->whereNull('deleted_at');
    }
}
