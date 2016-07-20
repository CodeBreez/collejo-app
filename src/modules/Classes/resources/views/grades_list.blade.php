@extends('collejo::dash.sections.table_view')

@section('title', trans('classes::grade.grades'))

@section('tools')

<a href="{{ route('grade.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('classes::grade.create_grade') }}</a>  

@endsection

@section('table')

@if($grades->count())

<table class="table">
                
    <tr>
        <th width="*">{{ trans('classes::grade.name') }}</th>
        <th width="20%">{{ trans('classes::grade.number_of_classes') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($grades as $grade)

    <tr>
        <td>
            <div>{{ $grade->name }}</div>
            <small class="text-muted">{{ $grade->id }}</small>
        </td>
        <td>{{ $grade->classes->count() }}</td>
        <td class="tools-column">
            <a href="{{ route('grade.details.edit', $grade->id) }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{ trans('common.edit') }}</a>
        </td>
    </tr>

    @endforeach

</table>

@else

<div class="placeholder-row">
    <div class="placeholder">{{ trans('classes::grade.empty_list') }}</div>
</div>

@endif

@endsection

