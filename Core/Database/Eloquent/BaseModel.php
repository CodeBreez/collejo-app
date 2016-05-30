<?php

namespace Collejo\Core\Database\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Uuid;

class BaseModel extends Model {

	public static function create(array $attributes = [])
    {
    	dd($attributes);
        $model = new static($attributes);

    	$model->id = Uuid::generate(4);

        $model->save();

        return $model;
    }
}