@extends('collejo::dash.sections.table_view')

@section('title', 'Students')

@section('tools')

<a href="{{ route('student.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Create New</a>	

@endsection

@section('table')

@if($students->count())

<table class="table" id="students">
                
    <tr>
        <th width="*">Name</th>
        <th width="20%">Admission Date</th>
        <th width="15%">Batch</th>
        <th width="10%">Grade</th>
        <th width="10%">Class</th>
        <th width="10%"></th>
    </tr>

    @foreach($students as $student)

        @include('students::partials.student')

    @endforeach

</table>

@else

<div class="placeholder">There are not students in the system.</div>

@endif

@endsection

