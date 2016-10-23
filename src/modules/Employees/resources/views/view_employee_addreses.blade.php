@extends('collejo::dash.sections.tab_view')

@section('title', $employee->name)

@section('tools')

<a href="{{ route('employee.addresses.edit', $employee->id) }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>  

@endsection

@section('tabs')

    @include('employees::partials.view_employee_tabs')

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