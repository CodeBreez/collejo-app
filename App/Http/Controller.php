<?php

namespace Collejo\App\Http;

use Collejo\App\Http\JsValidator\JsValidatorFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function printJson($success = false, $data = [], $msg = null)
    {
        return response()->json([
            'success' => $success,
            'data'    => $data,
            'message' => $msg,
        ]);
    }

    public function printRedirect($route, $msg = null)
    {
        return $this->printJson(true, ['redir' => $route], $msg);
    }

    public function printModal($view)
    {
        return $this->printJson(true, ['content' => $view->render()]);
    }

    public function printPartial($view, $msg = null, $target = null)
    {
        return $this->printJson(true, ['partial' => $view->render(), 'target' => Request::get('target', $target)], $msg);
    }

    public function jsValidator($validatorClass)
    {
        return JsValidatorFactory::create($validatorClass);
    }
}
