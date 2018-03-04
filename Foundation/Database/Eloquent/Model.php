<?php

namespace Collejo\Foundation\Database\Eloquent;

use Auth;
//use Collejo\App\Events\CriteriaDataChanged;
use Illuminate\Database\Eloquent\Model as Base;
use Schema;
use Webpatser\Uuid\Uuid;

abstract class Model extends Base
{
    public $incrementing = false;

    /**
     * Boot the model and bind event handlers
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $keyName = $model->getKeyName();

            $model->$keyName = $model->newUuid();

            $attributes = $model->getAllColumnsNames();

            if (Auth::user() && in_array('updated_by', $attributes)) {
                $model->attributes['updated_by'] = Auth::user()->id;
            }

            if (Auth::user() && in_array('created_by', $attributes)) {
                $model->attributes['created_by'] = Auth::user()->id;
            }
        });

        static::saving(function ($model) {
            $attributes = $model->getAllColumnsNames();

            if (Auth::user() && in_array('updated_by', $attributes)) {
                $model->attributes['updated_by'] = Auth::user()->id;
            }
        });

        static::created(function ($model) {
            //event(new CriteriaDataChanged($model));
        });

        static::updated(function ($model) {
            //event(new CriteriaDataChanged($model));
        });
    }

    /**
     * Generates a new UUID.
     *
     * @return string
     * @throws \Exception
     */
    public function newUuid()
    {
        return (string) Uuid::generate(4);
    }

    /**
     * Returns an array of columns for this model.
     *
     * @return mixed
     */
    public function getAllColumnsNames()
    {
        return Schema::getColumnListing($this->table);
    }
}
