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

    /**
     * Returns the relating batch.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    /**
     * Boot the model with event binding for updating
     * start and end dates fot the Batch.
     */
    public static function boot()
    {
        $changeEvent = function ($model) {
            if ($model->batch->terms->count()) {
                $model->batch->start_date = $model->batch->terms->first()->start_date;
                $model->batch->end_date = $model->batch->terms->last()->end_date;

                $model->batch->save();
            }
        };

        static::updated($changeEvent);
        static::created($changeEvent);
        static::deleted($changeEvent);

        parent::boot();
    }
}
