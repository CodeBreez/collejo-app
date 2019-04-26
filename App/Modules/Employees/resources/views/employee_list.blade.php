@extends('dashboard::layouts.table_view')

@section('title', trans('employees::employee.employees'))

@section('total', $employees->total())

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/employees/js/employeesList.js') }}"></script>
@endsection

@section('tools')

    @can('create_employee')

        <a href="{{ route('employee.new') }}" class="btn btn-primary">
            <i class="fa fa-fw fa-plus"></i> {{ trans('employees::employee.new_employee') }}
        </a>

    @endcan

@endsection

@section('table')

    <div id="employeesList">
        <employees-list
                @if($employees->count())
                :employees="{{$employees->toJson()}}"
                @endif
        ></employees-list>
    </div>

@endsection