<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class AssignStudentClassRequest extends Request
{
    public function rules()
    {
        return [
            'batch_id'        => 'required',
            'grade_id'        => 'required',
            'class_id'        => 'required',
        ];
    }
}
