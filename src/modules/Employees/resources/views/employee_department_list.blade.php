@extends('collejo::dash.sections.table_view')

@section('title', trans('employees::employee_department.employee_departments'))

@section('tools')

<a href="{{ route('employee_department.new') }}" data-toggle="ajax-modal"  class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('common.create') }}</a>	

@endsection

@section('table')

@if($employee_departments->count())

<table class="table" id="employee_departments">
                
    <tr>
        <th width="*">{{ trans('employees::employee_department.name') }}</th>
        <th width="20%">{{ trans('employees::employee_department.code') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($employee_departments as $employee_department)

        @include('employees::partials.employee_department')

    @endforeach

</table>

<div class="pagination-row">{{ $employee_departments->render() }}</div>

@else

<div class="placeholder-row">
	<div class="placeholder">{{ trans('employees::employee_department.empty_list') }}</div>
</div>

@endif

@endsection

