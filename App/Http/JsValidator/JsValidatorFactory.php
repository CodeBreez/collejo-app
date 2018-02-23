<?php

namespace Collejo\App\Http\JsValidator;

use Illuminate\Foundation\Http\FormRequest;

class JsValidatorFactory
{
    /**
     * Builds a new JsValidator from a given FormRequest class name
     *
     * @param $className
     * @return JsValidator
     * @throws \Exception
     */
    public static function create($className)
    {
        $class = new $className();

        if (!$class instanceof FormRequest) {
            throw new \Exception($className.' is not an instance of '.FormRequest::class);
        }

        return new JsValidator($class->rules(), $class->attributes());
    }
}
