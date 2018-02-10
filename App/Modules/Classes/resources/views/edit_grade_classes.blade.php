@extends('dashboard::layouts.tab_view')

@section('title', trans('classes::grade.edit_grade'))

@section('styles')
    @parent
    <link href="{{ mix('/assets/classes/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/classes/js/editGradeClasses.js') }}"></script>
@endsection

@section('breadcrumbs')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('grades.list') }}">{{ trans('classes::grade.grades_list') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('grade.details.view', $grade->id) }}">{{ $grade->name }}</a>
        </li>
        <li class="breadcrumb-item active">{{ trans('classes::grade.edit_grade') }}</li>
    </ol>

@endsection

@section('tabs')

    @include('classes::partials.edit_grade_tabs')

@endsection

@section('tab')

    <div id="editGradeClasses">
        <edit-grade-classes :batch="{{$grade}}" :classes="{{$grade->classes}}"></edit-grade-classes>
    </div>

@endsection