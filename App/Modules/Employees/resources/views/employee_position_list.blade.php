@extends('dashboard::layouts.table_view')

@section('title', trans('employees::employee_position.employee_positions'))

@section('total', $employee_positions->total())

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/employees/js/employeePositionsList.js') }}"></script>
@endsection

@section('tools')

    @can('add_edit_employee_position')

        <a href="{{ route('employee_position.new') }}" class="btn btn-primary">
            <i class="fa fa-fw fa-plus"></i> {{ trans('employees::employee_position.new_employee_position') }}
        </a>

    @endcan

@endsection

@section('table')

    <div id="employeePositionsList">
        <employee-positions-list
                @if($employee_positions->count())
                :employee-positions="{{$employee_positions->toJson()}}"
                @endif
        ></employee-positions-list>
    </div>

@endsection