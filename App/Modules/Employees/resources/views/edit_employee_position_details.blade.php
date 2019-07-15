@extends('dashboard::layouts.tab_view')

@section('title', $employee_position ? trans('employees::employee_position.edit_employee_position') : trans('employees::employee_position.new_employee_position'))

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/employees/js/editEmployeePositionDetails.js') }}"></script>
@endsection

@section('breadcrumbs')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('employee_positions.list') }}">{{ trans('employees::employee_position.employee_positions') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ $employee_position ? trans('employees::employee_position.edit_employee_position') : trans('employees::employee_position.new_employee_position') }}</li>
    </ol>

@endsection

@section('tabs')

    @include('employees::partials.edit_employee_position_tabs')

@endsection

@section('tab')

    <div id="editEmployeePositionDetails">
        <edit-employee-position-details
                @if($employee_position)
                :entity="{{collect($employee_position)}}"
                @endif
                :employee-categories="{{$employee_categories->toJson()}}"
                :validation="{{$position_form_validator->renderRules()}}">

        </edit-employee-position-details>
    </div>

@endsection