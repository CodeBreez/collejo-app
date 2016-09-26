<?php

namespace Collejo\App\Database\Eloquent;

use Illuminate\Database\Eloquent\Model as Base;
use Uuid;
use Auth;
use Schema;

abstract class Model extends Base {

	public $incrementing = false;

	protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->{$model->getKeyName()} = $model->newUuid();

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
    }

    public function newUuid()
    {
        return (string) Uuid::generate(4);
    }

    public function getAllColumnsNames()
    {
        return Schema::getColumnListing($this->table);
    }
}