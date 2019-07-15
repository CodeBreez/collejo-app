@extends('dashboard::layouts.tab_view')

@section('title', $employee->name)

@section('tools')

	@can('edit_employee_general_details')
		<a href="{{ route('employee.details.edit', $employee->id) }}" class="btn btn-primary">
			<i class="fa fa-fw fa-edit"></i> {{ trans('base::common.edit') }}
		</a>
	@endcan

@endsection

@section('tabs')

	@include('employees::partials.view_employee_tabs')

@endsection

@section('tab')

	<div class="col-sm-6">
		<dl class="row">
			@if($employee->picture)
				<img class="img-lazy thumbnail img-responsive" src="{{ $employee->picture->small_url }}">
			@else
				<img class="thumbnail img-responsive" src="{{ asset('/images/user_avatar_small.png') }}">
			@endif
		</dl>
		<dl class="row">
			<dt class="col-sm-4">{{ trans('employees::employee.employee_number') }}</dt>
			<dd class="col-sm-8">{{ $employee->employee_number }}</dd>
		</dl>
		<dl class="row">
			<dt class="col-sm-4">{{ trans('employees::employee.joined_on') }}</dt>
			<dd class="col-sm-8">{{ dateFormat(dateToUserTz($employee->joined_on)) }}</dd>
		</dl>
		<dl class="row">
			<dt class="col-sm-4">{{ trans('employees::employee.name') }}</dt>
			<dd class="col-sm-8">{{ $employee->name }}</dd>
		</dl>
		<dl class="row">
			<dt class="col-sm-4">{{ trans('employees::employee.date_of_birth') }}</dt>
			<dd class="col-sm-8">{{ $employee->date_of_birth }}</dd>
		</dl>
		<dl class="row">
			<dt class="col-sm-4">{{ trans('employees::employee.employee_category') }}</dt>
			<dd class="col-sm-8">{{ $employee->employeePosition->employeeCategory->name }}</dd>
		</dl>
		<dl class="row">
			<dt class="col-sm-4">{{ trans('employees::employee.employee_position') }}</dt>
			<dd class="col-sm-8">{{ $employee->employeePosition->name }}</dd>
		</dl>
		<dl class="row">
			<dt class="col-sm-4">{{ trans('employees::employee.employee_department') }}</dt>
			<dd class="col-sm-8">{{ $employee->employeeDepartment->name }}</dd>
		</dl>
		<dl class="row">
			<dt class="col-sm-4">{{ trans('employees::employee.employee_grade') }}</dt>
			<dd class="col-sm-8">{{ $employee->employeeGrade->name }}</dd>
		</dl>
	</div>

@endsection