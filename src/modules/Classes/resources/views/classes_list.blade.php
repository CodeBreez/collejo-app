@extends('collejo::dash.sections.table_view')

@section('title', 'Classes')

@section('tools')

<a href="{{ route('classes.class.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Create Class</a>  

@endsection

@section('table')

@if($classes->count())

<table class="table">
                
    <tr>
        <th>Name</th>
        <th></th>
    </tr>

    @foreach($classes as $class)

    <tr>
        <td>
            <div>{{ $class->name }}</div>
            <small class="text-muted">{{ $class->id }}</small>
        </td>
        <td class="tools-column">
            <a href="{{ route('classes.class.edit', $class->id) }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</a>
        </td>
    </tr>

    @endforeach

</table>

@else

<div class="placeholder-row">
    <div class="placeholder">There are no classes in the system.</div>
</div>

@endif

@endsection

