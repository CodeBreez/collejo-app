@extends('collejo::dash.sections.table_view')

@section('title', trans('employees::employee_grade.employee_grades'))

@section('tools')

<a href="{{ route('employee_grade.new') }}" data-toggle="ajax-modal"  class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('common.create') }}</a>	

@endsection

@section('table')

@if($employee_grades->count())

<table class="table" id="employee_grades">
                
    <tr>
        <th width="*">{{ trans('employees::employee_grade.name') }}</th>
        <th width="20%">{{ trans('employees::employee_grade.code') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($employee_grades as $employee_grade)

        @include('employees::partials.employee_grade')

    @endforeach

</table>

@else

<div class="placeholder-row">
	<div class="placeholder">{{ trans('employees::employee_grade.empty_list') }}</div>
</div>

@endif

@endsection

