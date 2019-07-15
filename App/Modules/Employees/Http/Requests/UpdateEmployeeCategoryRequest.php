<?php

namespace Collejo\App\Modules\Employees\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class UpdateEmployeeCategoryRequest extends Request
{
    public function rules()
    {
        $createRequest = new CreateEmployeeCategoryRequest();

        return array_merge($createRequest->rules(), [
                'name' => 'required|unique:employee_categories,name,'.$this->json('id'),
                'code' => 'max:5|unique:employee_categories,code,'.$this->json('id'),
            ]);
    }

    public function attributes()
    {
        $createRequest = new CreateEmployeeCategoryRequest();

        return $createRequest->attributes();
    }
}
