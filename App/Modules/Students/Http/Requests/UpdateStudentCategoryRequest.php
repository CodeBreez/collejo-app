<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class UpdateStudentCategoryRequest extends Request
{
    public function rules()
    {
        $createRequest = new CreateStudentCategoryRequest();

        return array_merge($createRequest->rules(), [
                'name' => 'required|unique:student_categories,name,'.$this->json('id'),
                'code' => 'required|max:5|unique:student_categories,code,'.$this->json('id'),
            ]);
    }

    public function attributes()
    {
        $createRequest = new CreateStudentCategoryRequest();

        return $createRequest->attributes();
    }
}
