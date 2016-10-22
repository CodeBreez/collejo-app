@extends('collejo::dash.sections.table_view')

@section('title', trans('employees::employee_category.employee_categories'))

@section('count', $employee_categories->total())

@section('tools')

<a href="{{ route('employee_category.new') }}" data-toggle="ajax-modal"  class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('common.create') }}</a>	

@endsection

@section('table')

@if($employee_categories->count())

<table class="table" id="employee_categories">
                
    <tr>
        <th width="*">{{ trans('employees::employee_category.name') }}</th>
        <th width="20%">{{ trans('employees::employee_category.code') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($employee_categories as $employee_category)

        @include('employees::partials.employee_category')

    @endforeach

</table>

<div class="pagination-row">{{ $employee_categories->render() }}</div>

@else

<div class="placeholder-row">
	<div class="placeholder">{{ trans('employees::employee_category.empty_list') }}</div>
</div>

@endif

@endsection

