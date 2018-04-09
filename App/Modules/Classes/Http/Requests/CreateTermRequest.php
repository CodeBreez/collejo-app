<?php

namespace Collejo\App\Modules\Classes\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class CreateTermRequest extends Request
{
    public function rules()
    {
        return [
            'name'       => 'required',
            'start_date' => 'required',
            'end_date'   => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'       => trans('classes::term.name'),
            'start_date' => trans('classes::batch.start_date'),
            'end_date'   => trans('classes::batch.end_date'),
        ];
    }
}
