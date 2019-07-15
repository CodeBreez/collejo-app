@extends('dashboard::layouts.tab_view')

@section('title', $employee_grade ? trans('employees::employee_grade.edit_employee_grade') : trans('employees::employee_grade.new_employee_grade'))

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/employees/js/editEmployeeGradeDetails.js') }}"></script>
@endsection

@section('breadcrumbs')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('employee_grades.list') }}">{{ trans('employees::employee_grade.employee_grades') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ $employee_grade ? trans('employees::employee_grade.edit_employee_grade') : trans('employees::employee_grade.new_employee_grade') }}</li>
    </ol>

@endsection

@section('tabs')

    @include('employees::partials.edit_employee_grade_tabs')

@endsection

@section('tab')

    <div id="editEmployeeGradeDetails">
        <edit-employee-grade-details
                @if($employee_grade)
                :entity="{{collect($employee_grade)}}"
                @endif
                :validation="{{$grade_form_validator->renderRules()}}">

        </edit-employee-grade-details>
    </div>

@endsection