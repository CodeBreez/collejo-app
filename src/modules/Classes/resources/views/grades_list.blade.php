@extends('collejo::dash.sections.table_view')

@section('title', trans('classes::grade.grades'))

@section('tools')

<a href="{{ route('grade.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('classes::grade.create_grade') }}</a>  

@endsection

@section('table')

@if($grades->count())

<table class="table">
                
    <tr>
        <th width="25%">{{ trans('classes::grade.name') }}</th>
        <th width="*">{{ trans('classes::grade.classes') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($grades as $grade)

    <tr>
        <td>
            <div><a href="{{ route('grade.details.view', $grade->id) }}">{{ $grade->name }}</a></div>
        </td>
        <td>
            @if($grade->classes->count())
                @foreach($grade->classes as $class)
                    <span class="label label-default"><a href="#">{{ $class->name }}</a></span>
                @endforeach
            @else
                <a href="{{ route('grade.classes.edit', $grade->id) }}" class="btn btn-xs btn-warning">{{ trans('classes::grade.create_classes') }}</a>
            @endif
        </td>
        <td class="tools-column">
            <a href="{{ route('grade.details.edit', $grade->id) }}" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
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

