@extends('collejo::dash.sections.table_view')

@section('title', 'Students')

@section('tools')

<a href="{{ route('students.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Create New</a>	

@endsection

@section('table')

<table class="table">
                
    <tr>
        <th>Name</th>
        <th></th>
    </tr>

    @foreach($students as $student)

    <tr>
        <td>
            <div>{{ $student->name }}</div>
            <small class="text-muted">{{ $student->admission_number }}</small>
        </td>
        <td class="tools-column">
            <a href="{{ route('students.edit.details', $student->id) }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</a>
        </td>
    </tr>

    @endforeach

</table>

@endsection

