@extends('dashboard::layouts.table_view')

@section('title', trans('employees::employee_grade.employee_grades'))

@section('total', $employee_grades->total())

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/employees/js/employeeGradesList.js') }}"></script>
@endsection

@section('tools')

    @can('add_edit_employee_grade')

        <a href="{{ route('employee_grade.new') }}" class="btn btn-primary">
            <i class="fa fa-fw fa-plus"></i> {{ trans('employees::employee_grade.new_employee_grade') }}
        </a>

    @endcan

@endsection

@section('table')

    <div id="employeeGradesList">
        <employee-grades-list
                @if($employee_grades->count())
                :employee-grades="{{$employee_grades->toJson()}}"
                @endif
        ></employee-grades-list>
    </div>

@endsection