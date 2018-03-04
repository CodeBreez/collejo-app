@extends('dashboard::layouts.tab_view')

@section('title', $grade ? trans('classes::grade.edit_grade') : trans('classes::grade.new_grade'))

@section('styles')
    @parent
    <link href="{{ mix('/assets/classes/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/classes/js/editGradeDetails.js') }}"></script>
@endsection

@section('breadcrumbs')

@if($grade)

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('grades.list') }}">{{ trans('classes::grade.grades') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('grade.details.view', $grade->id) }}">{{ $grade->name }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('classes::grade.edit_grade') }}</li>
</ol>

@endif

@endsection

@section('tabs')

    @include('classes::partials.edit_grade_tabs')

@endsection

@section('tab')

    <div id="editGradeDetails">
        <edit-grade-details
                @if($grade)
                :grade="{{$grade}}"
                @endif
                :validation="{{$grade_form_validator->renderRules()}}">

        </edit-grade-details>
    </div>

@endsection