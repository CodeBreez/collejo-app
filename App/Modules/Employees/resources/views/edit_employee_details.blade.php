@extends('dashboard::layouts.tab_view')

@section('title', $employee ? trans('employees::employee.edit_employee') : trans('employees::employee.new_employee'))

@section('styles')
    @parent
    <link href="{{ mix('/assets/media/css/uploader.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/media/js/uploader.js') }}"></script>
    <script type="text/javascript" src="{{ mix('/assets/employees/js/editEmployeeDetails.js') }}"></script>
@endsection

@section('breadcrumbs')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('employees.list') }}">{{ trans('employees::employee.employees_list') }}</a>
        </li>
        @if($employee)
            <li class="breadcrumb-item">
                <a href="{{ route('employee.details.view', $employee->id) }}">{{ $employee->name }}</a>
            </li>
        @endif
        <li class="breadcrumb-item active">{{ $employee ? trans('employees::employee.edit_employee') : trans('employees::employee.new_employee') }}</li>
    </ol>

@endsection

@section('tabs')

    @include('employees::partials.edit_employee_tabs')

@endsection

@section('tab')

    <div id="editEmployeeDetails">
        <edit-employee-details
                @if($employee)
                :entity="{{collect($employee)}}"
                @endif
                :employee-positions="{{collect($employee_positions)}}"
                :employee-departments="{{collect($employee_departments)}}"
                :employee-grades="{{collect($employee_grades)}}"
                :validation="{{$employee_form_validator->renderRules()}}">

        </edit-employee-details>
    </div>

@endsection