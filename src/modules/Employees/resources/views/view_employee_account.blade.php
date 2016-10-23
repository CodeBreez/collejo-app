@extends('collejo::dash.sections.tab_view')

@section('title', $employee->name)

@section('tools')

@can('edit_user_account_info')
	<a href="{{ route('employee.account.edit', $employee->id) }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>  
@endcan

@endsection

@section('tabs')

    @include('employees::partials.view_employee_tabs')

@endsection

@section('tab')

<div class="col-sm-6">
	<dl class="row">
		<dt class="col-sm-4">{{ trans('employees::employee.email') }}</dt>
		<dd class="col-sm-8">{{ $employee->user->email }}</dd>
	</dl>	
</div>

@endsection