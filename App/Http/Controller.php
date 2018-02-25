<?php

namespace Collejo\App\Http;

use Collejo\App\Http\JsValidator\JsValidatorFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Prints a json response.
     *
     * @param bool  $success
     * @param array $data
     * @param null  $msg
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function printJson($success = false, $data = [], $msg = null)
    {
        return response()->json([
            'success' => $success,
            'data'    => $data,
            'message' => $msg,
        ]);
    }

    /**
     * Prints a json response that would be identified as a redirect.
     *
     * @param $route
     * @param null $msg
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function printRedirect($route, $msg = null)
    {
        return $this->printJson(true, ['redir' => $route], $msg);
    }

    /**
     * Returns a JsValidator object from FormRequest object.
     *
     * @param $validatorClass
     *
     * @throws \Exception
     *
     * @return JsValidator\JsValidator
     */
    public function jsValidator($validatorClass)
    {
        return JsValidatorFactory::create($validatorClass);
    }
}
