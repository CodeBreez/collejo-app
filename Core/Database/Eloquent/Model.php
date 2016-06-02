<?php

namespace Collejo\Core\Database\Eloquent;

use Illuminate\Database\Eloquent\Model as Base;
use Uuid;

class Model extends Base {

	public $incrementing = false;

	protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string)$model->generateNewId();
        });
    }

    public function generateNewId()
    {
        return Uuid::generate(4);
    }
}