@extends('dashboard::layouts.tab_view')

@section('title', $employee_department ? trans('employees::employee_department.edit_employee_department') : trans('employees::employee_department.new_employee_department'))

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/employees/js/editEmployeeDepartmentDetails.js') }}"></script>
@endsection

@section('breadcrumbs')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('employee_departments.list') }}">{{ trans('employees::employee_department.employee_departments') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ $employee_department ? trans('employees::employee_department.edit_employee_department') : trans('employees::employee_department.new_employee_department') }}</li>
    </ol>

@endsection

@section('tabs')

    @include('employees::partials.edit_employee_department_tabs')

@endsection

@section('tab')

    <div id="editEmployeeDepartmentDetails">
        <edit-employee-department-details
                @if($employee_department)
                :entity="{{collect($employee_department)}}"
                @endif
                :validation="{{$department_form_validator->renderRules()}}">

        </edit-employee-department-details>
    </div>

@endsection