<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class UpdateStudentDetailsRequest extends Request
{
    public function rules()
    {
        $createRequest = new CreateStudentRequest();

        return array_merge($createRequest->rules(), [
                'admission_number' => 'required|unique:students,admission_number,'.$this->json('id'),
            ]);
    }

    public function attributes()
    {
        $createRequest = new CreateStudentRequest();

        return $createRequest->attributes();
    }
}
