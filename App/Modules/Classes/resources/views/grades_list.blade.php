@extends('dashboard::layouts.table_view')

@section('title', trans('classes::grade.grades_list'))

@section('styles')
    @parent
    <link href="{{ mix('/assets/classes/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/classes/js/gradesList.js') }}"></script>
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