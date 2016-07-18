@extends('collejo::dash.sections.table_view')

@section('title', 'Employees')

@section('tools')

<a href="{{ route('employee.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Create New</a>	

@endsection

@section('table')

@if($employees->count())

<table class="table" id="employees">
                
    <tr>
        <th width="*">Name</th>
        <th width="20%">Joined Date</th>
        <th width="10%"></th>
    </tr>

    @foreach($employees as $employee)

        @include('employees::partials.employee')

    @endforeach

</table>

@else

<div class="placeholder">There are not employees in the system.</div>

@endif

@endsection

