@extends('collejo::dash.sections.tab_view')

@section('title', $employee->name)

@section('breadcrumbs')

<ol class="breadcrumb">
  <li><a href="{{ route('employees.list') }}">{{ trans('employees::employee.employees_list') }}</a></li>
  <li><a href="{{ route('employee.addresses.view', $employee->id) }}">{{ $employee->name }}</a></li>
  <li class="active">{{ trans('employees::employee.edit_employee') }}</li>
</ol>

@endsection

@section('tools')

<a href="{{ route('employee.address.new', $employee->id) }}" data-modal-backdrop="static" data-modal-keyboard="false" class="btn btn-primary pull-right" data-toggle="ajax-modal"><i class="fa fa-plus"></i> {{ trans('employees::address.new_address') }}</a>  

@endsection

@section('tabs')

    @include('employees::partials.edit_employee_tabs')

@endsection

@section('tab')


<div id="addresses" class="column-list">

    <div class="columns">

        @foreach($employee->addresses as $address)

            @include('employees::partials.address')

        @endforeach

    </div>

    <div class="col-md-6">
        <div class="placeholder">{{ trans('employees::address.empty_list') }}</div>
    </div>


</div>  

<div class="clearfix"></div>


@endsection