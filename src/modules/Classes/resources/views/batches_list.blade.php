@extends('collejo::dash.sections.table_view')

@section('title', trans('classes::batch.batches'))

@section('count', $batches->total())

@section('tools')

    @can('add_edit_batch')
        <a href="{{ route('batch.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('classes::batch.create_batch') }}</a>  
    @endcan

@endsection

@section('table')

@if($batches->count())

<table class="table">
                
    <tr>
        <th width="30%">{{ trans('classes::batch.name') }}</th>
        <th width="*">{{ trans('classes::batch.grades') }}</th>
        <th width="10%"></th>
        <th width="10%"></th>
        <th width="10%"></th>
    </tr>

    @foreach($batches as $batch)

    <tr>
        <td>
            <div>
                @can('view_batch_details')
                    <a href="{{ route('batch.details.view', $batch->id) }}">{{ $batch->name }}</a>
                @endcan
                @cannot('view_batch_details')
                    {{ $batch->name }}
                @endcan
            </div>
        </td>
        <td>
            @if($batch->grades->count())
                @foreach($batch->grades as $grade)
                    <span class="label label-default">
                        @can('view_grade_details')
                            <a href="{{ route('grade.details.view', $grade->id) }}">{{ $grade->name }}</a>
                        @endcan

                        @cannot('view_grade_details')
                            {{ $grade->name }}
                        @endcannot
                    </span>
                @endforeach
            @else
                @can('add_edit_batch')
                    <a href="{{ route('batch.grades.edit', $batch->id) }}" class="btn btn-xs btn-warning">{{ trans('classes::batch.assign_grades') }}</a>
                @endcan
            @endif
        </td>
        <td>
            @if($batch->trashed())
                <span class="label label-danger">{{ trans('common.active') }}</span>
            @else 
                <span class="label label-success">{{ trans('common.inactive') }}</span>
            @endif
        </td>
        <td>
            @can('list_students')
                <a href="{{ route('students.list') }}?batch={{ $batch->id }}" class="btn btn-xs btn-default">{{ trans('classes::batch.view_students') }}</a>
            @endcan
        </td>
        <td class="tools-column">
            @can('add_edit_batch')
                <a href="{{ route('batch.details.edit', $batch->id) }}" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
            @endcan
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

