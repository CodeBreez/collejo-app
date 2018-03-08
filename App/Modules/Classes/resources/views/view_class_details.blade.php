@extends('dashboard::layouts.tab_view')

@section('title', $class->name)

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('grades.list') }}">{{ trans('classes::grade.grades') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('grade.details.view', $grade->id) }}">{{ $grade->name }}</a>
        </li>
        <li class="breadcrumb-item active">{{ trans('classes::class.class_details') }}</li>
    </ol>
@endsection

@section('tabs')

    @include('classes::partials.view_class_tabs')

@endsection

@section('tab')

    <div class="col-sm-6">
        <dl class="row">
            <dt class="col-sm-4">{{ trans('classes::class.name') }}</dt>
            <dd class="col-sm-8">{{ $class->name }}</dd>
        </dl>
    </div>

@endsection