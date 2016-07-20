@extends('collejo::dash.sections.table_view')

@section('title', trans('classes::batch.batches'))

@section('tools')

<a href="{{ route('batch.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('classes::batch.create_batch') }}</a>  

@endsection

@section('table')

@if($batches->count())

<table class="table">
                
    <tr>
        <th width="*">{{ trans('classes::batch.name') }}</th>
        <th width="20%">{{ trans('classes::batch.grades') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($batches as $batch)

    <tr>
        <td>
            <div>{{ $batch->name }}</div>
            <small class="text-muted">{{ $batch->id }}</small>
        </td>
        <td>{{ $batch->grades->count() }}</td>
        <td class="tools-column">
            <a href="{{ route('batch.details.edit', $batch->id) }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{ trans('common.edit') }}</a>
        </td>
    </tr>

    @endforeach

</table>

@else

<div class="placeholder-row">
    <div class="placeholder">{{ trans('classes::batch.empty_list') }}</div>
</div>

@endif

@endsection

