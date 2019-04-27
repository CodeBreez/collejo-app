@extends('dashboard::layouts.table_view')

@section('title', trans('employees::employee_department.employee_departments'))

@section('total', $employee_departments->total())

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/employees/js/employeeDepartmentsList.js') }}"></script>
@endsection

@section('tools')

    @can('add_edit_employee_department')

        <a href="{{ route('employee_department.new') }}" class="btn btn-primary">
            <i class="fa fa-fw fa-plus"></i> {{ trans('employees::employee_department.new_employee_department') }}
        </a>

    @endcan

@endsection

@section('table')

    <div id="employeeDepartmentsList">
        <employee-departments-list
                @if($employee_departments->count())
                :employee-departments="{{$employee_departments->toJson()}}"
                @endif
        ></employee-departments-list>
    </div>

@endsection