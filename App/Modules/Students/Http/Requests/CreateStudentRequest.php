<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class CreateStudentRequest extends Request
{
    public function rules()
    {
        return [
            'admission_number'    => 'required|unique:students',
            'admitted_on'         => 'required',
            'student_category_id' => 'required',
            'first_name'          => 'required',
            'last_name'           => 'required',
            'date_of_birth'       => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'admission_number'    => trans('students::student.admission_number'),
            'admitted_on'         => trans('students::student.admitted_on'),
            'student_category_id' => trans('students::student.student_category_id'),
            'first_name'          => trans('students::student.first_name'),
            'last_name'           => trans('students::student.last_name'),
            'date_of_birth'       => trans('students::student.date_of_birth'),
        ];
    }
}
