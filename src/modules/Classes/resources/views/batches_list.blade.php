@extends('collejo::dash.sections.table_view')

@section('title', 'Batches')

@section('tools')

<a href="{{ route('classes.batch.new') }}" data-toggle="ajax-modal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Create Batch</a>  

@endsection

@section('table')

@if($batches->count())

<table class="table">
                
    <tr>
        <th>Name</th>
        <th></th>
    </tr>

    @foreach($batches as $batch)

    <tr>
        <td>
            <div>{{ $batch->name }}</div>
            <small class="text-muted">{{ $batch->id }}</small>
        </td>
        <td class="tools-column">
            <a href="{{ route('classes.batch.edit', $batch->id) }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</a>
        </td>
    </tr>

    @endforeach

</table>

@else

<div class="placeholder">There are no batches in the system.</div>

@endif

@endsection

