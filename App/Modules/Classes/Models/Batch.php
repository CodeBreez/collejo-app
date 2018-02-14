<?php

namespace Collejo\App\Modules\Classes\Models;

use Collejo\Foundation\Database\Eloquent\Model;
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
