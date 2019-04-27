<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class UpdateGuardianRequest extends Request
{
    public function rules()
    {
        $createRequest = new CreateGuardianRequest();

        return array_merge($createRequest->rules(), [
            'ssn' => 'required|unique:guardians,ssn,'.$this->json('id'),
        ]);
    }

    public function attributes()
    {
        $createRequest = new CreateGuardianRequest();

        return $createRequest->attributes();
    }
}
