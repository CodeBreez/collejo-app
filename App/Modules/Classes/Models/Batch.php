<?php

namespace Collejo\App\Modules\Classes\Models;

use Collejo\Foundation\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use SoftDeletes;

    protected $table = 'batches';

    protected $fillable = ['name', 'start_date', 'end_date'];

    protected $dates = ['start_date', 'end_date'];

    /**
     * Returns the relative Terms for this Batch.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function terms()
    {
        return $this->hasMany(Term::class)->orderBy('start_date');
    }

    /**
     * Returns the relative Grades for this Batch.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grades()
    {
        return $this->belongsToMany(Grade::class);
    }

    /**
     * Set the scope to active Batches.
     *
     * @return mixed
     */
    public function scopeActive()
    {
        return $this->whereNull('deleted_at');
    }
}
