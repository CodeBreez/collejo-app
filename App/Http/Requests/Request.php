<?php

namespace Collejo\Foundation\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

abstract class Request extends FormRequest
{
    protected $authorize = true;

    /**
     * Tells the framework that this request needs to be authorized.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->authorize;
    }

    /**
     * Formats form validation errors.
     *
     * @param Validator $validator
     *
     * @return array
     */
    public function formatErrors(Validator $validator)
    {
        return [
            'success' => false,
            'data'    => [
                'errors' => $validator->errors()->getMessages(),
            ],
        ];
    }

    /**
     * Returns a json response.
     *
     * @param array $errors
     *
     * @return $this|JsonResponse
     */
    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }
}
