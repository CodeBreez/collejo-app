<?php

namespace Collejo\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

abstract class Request extends FormRequest
{

	protected $authorize = true;
    
    public function authorize()
	{
	    return $this->authorize;
	}

	public function formatErrors(Validator $validator)
    {
        return ['success' => false, 'data' => ['errors' => $validator->errors()->getMessages()]];
    }

    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }
}
