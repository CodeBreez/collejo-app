@extends('collejo::dash.sections.table_view')

@section('title', 'Grades')

@section('tools')

<a href="{{ route('grade.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Create Grade</a>  

@endsection

@section('table')

@if($grades->count())

<table class="table">
                
    <tr>
        <th>Name</th>
        <th>Number of Classes</th>
        <th></th>
    </tr>

    @foreach($grades as $grade)

    <tr>
        <td>
            <div>{{ $grade->name }}</div>
            <small class="text-muted">{{ $grade->id }}</small>
        </td>
        <td>{{ $grade->classes->count() }}</td>
        <td class="tools-column">
            <a href="{{ route('grade.detail.edit', $grade->id) }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</a>
        </td>
    </tr>

    @endforeach

</table>

@else

<div class="placeholder-row">
    <div class="placeholder">There are no grades in the system.</div>
</div>

@endif

@endsection

