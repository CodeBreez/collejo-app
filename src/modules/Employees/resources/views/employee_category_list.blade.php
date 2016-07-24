@extends('collejo::dash.sections.table_view')

@section('title', trans('employees::employee_category.employee_categories'))

@section('tools')

<a href="{{ route('employee.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Create New</a>	

@endsection

@section('table')

@if($employee_categories->count())

<table class="table" id="employees">
                
    <tr>
        <th width="*">Name</th>
        <th width="20%">Joined Date</th>
        <th width="10%"></th>
    </tr>

    @foreach($employee_categories as $employee_category)

        @include('employees::partials.employee_category')

    @endforeach

</table>

@else

<div class="placeholder-row">
	<div class="placeholder">There are not employees in the system.</div>
</div>

@endif

@endsection

