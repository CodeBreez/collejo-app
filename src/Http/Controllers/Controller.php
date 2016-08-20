<?php

namespace Collejo\App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Request;
use JsValidate;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function printJson($success = false, $data = [], $msg = null)
    {
        return response()->json([
            'success' => $success,
            'data' => $data,
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
        return JsValidate::create($validatorClass);
    }
}
