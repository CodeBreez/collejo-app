@extends('collejo::dash.sections.table_view')

@section('title', trans('classes::batch.batches'))

@section('tools')

<a href="{{ route('batch.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('classes::batch.create_batch') }}</a>  

@endsection

@section('table')

@if($batches->count())

<table class="table">
                
    <tr>
        <th width="30%">{{ trans('classes::batch.name') }}</th>
        <th width="*">{{ trans('classes::batch.grades') }}</th>
        <th width="10%"></th>
        <th width="10%"></th>
    </tr>

    @foreach($batches as $batch)

    <tr>
        <td>
            <div><a href="{{ route('batch.details.view', $batch->id) }}">{{ $batch->name }}</a></div>
        </td>
        <td>
            @if($batch->grades->count())
                @foreach($batch->grades as $grade)
                    <span class="label label-default"><a href="#">{{ $grade->name }}</a></span>
                @endforeach
            @else
                <a href="{{ route('batch.grades.edit', $batch->id) }}" class="btn btn-xs btn-warning">{{ trans('classes::batch.assign_grades') }}</a>
            @endif
        </td>
        <td>
            @if($batch->trashed())
                <span class="label label-danger">Inactive</span>
            @else 
                <span class="label label-success">Active</span>
            @endif
        </td>
        <td class="tools-column">
            <a href="{{ route('batch.details.edit', $batch->id) }}" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
        </td>
    </tr>

    @endforeach

</table>

<div class="pagination-row">{{ $batches->render() }}</div>

@else

<div class="placeholder-row">
    <div class="placeholder">{{ trans('classes::batch.empty_list') }}</div>
</div>

@endif

@endsection

