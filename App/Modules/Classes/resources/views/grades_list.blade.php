@extends('dashboard::layouts.table_view')

@section('title', trans('classes::grade.grades'))

@section('count', $grades->count())

@section('styles')
    @parent
    <link href="{{ mix('/assets/classes/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/classes/js/gradesList.js') }}"></script>
@endsection

@section('tools')

    @can('add_edit_grade')

        <a href="{{ route('grade.new') }}" class="btn btn-primary"><i
                    class="fa fa-fw fa-plus"></i> {{ trans('classes::grade.new_grade') }}</a>

    @endcan

@endsection

@section('table')

    <div id="gradesList">
        <grades-list
                @if($grades->count())
                :grades="{{$grades->toJson()}}"
                @endif
        ></grades-list>
    </div>

@endsection