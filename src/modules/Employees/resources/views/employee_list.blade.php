@extends('collejo::dash.sections.table_view')

@section('title', trans('employees::employee.employees'))

@section('tools')

<a href="{{ route('employee.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('common.create_new') }}</a>	

@endsection

@section('table')

@if($employees->count())

<table class="table" id="employees">
                
    <tr>
        <th width="*">{{ trans('employees::employee.name') }}</th>
        <th width="20%">{{ trans('employees::employee.joined_on') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($employees as $employee)

        @include('employees::partials.employee')

    @endforeach

</table>

@else

<div class="placeholder-row">
	<div class="placeholder">{{ trans('employees::employee.empty_list') }}</div>
</div>

@endif

@endsection
