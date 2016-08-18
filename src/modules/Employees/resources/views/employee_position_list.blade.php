@extends('collejo::dash.sections.table_view')

@section('title', trans('employees::employee_position.employee_positions'))

@section('tools')

<a href="{{ route('employee_position.new') }}" data-toggle="ajax-modal"  class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('common.create') }}</a>	

@endsection

@section('table')

@if($employee_positions->count())

<table class="table" id="employee_positions">
                
    <tr>
        <th width="*">{{ trans('employees::employee_position.name') }}</th>
        <th width="20%">{{ trans('employees::employee_position.code') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($employee_positions as $employee_position)

        @include('employees::partials.employee_position')

    @endforeach

</table>

@else

<div class="placeholder-row">
	<div class="placeholder">{{ trans('employees::employee_position.empty_list') }}</div>
</div>

@endif

@endsection

