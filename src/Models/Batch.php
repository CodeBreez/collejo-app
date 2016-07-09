<?php

namespace Collejo\App\Models;

use Collejo\Core\Database\Eloquent\Model;
use Collejo\App\Models\Term;

class Batch extends Model
{

    protected $table = 'batches';

    protected $fillable = ['name', 'is_ended'];

    protected $casts = [
    	'is_ended' => 'boolean'
    ];

    public function terms()
    {
    	return $this->hasMany(Term::class);
    }

    public function scopeActive($query)
    {
    	return $query->where('is_ended', false);
    }
}
