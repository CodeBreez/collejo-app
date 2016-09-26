<?php

namespace Collejo\App\Models;

use Collejo\App\Database\Eloquent\Model;
use Collejo\App\Models\Term;
use Collejo\App\Models\Grade;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{

    use SoftDeletes;
    
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
