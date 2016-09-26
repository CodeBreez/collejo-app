<?php

namespace Collejo\App\Http\JsValidator;

use Illuminate\Foundation\Http\FormRequest;

class JsValidatorFactory
{

	public static function create($className)
	{
		$class = new $className;

		if (!$class instanceOf FormRequest) {
			throw new \Exception($className . ' is not an instance of ' . FormRequest::class);
		}

		return new JsValidator($class->rules(), $class->attributes());
	}
}