@extends('dashboard::layouts.tab_view')

@section('title', $student->name)

@section('tools')

    @can('edit_student_general_details')
        <a href="{{ route('student.details.edit', $student->id) }}" class="btn btn-primary">
            <i class="fa fa-fw fa-edit"></i> {{ trans('base::common.edit') }}
        </a>
    @endcan

@endsection

@section('tabs')

    @include('students::partials.view_student_tabs')

@endsection

@section('tab')

    <div class="col-sm-6">
        <dl class="row">
            @if($student->picture)
                <img class="img-lazy thumbnail img-responsive" src="{{ $student->picture->small_url }}">
            @else
                <img class="thumbnail img-responsive" src="{{ asset('/images/user_avatar_small.png') }}">
            @endif
        </dl>
        <dl class="row">
            <dt class="col-sm-4">{{ trans('students::student.admission_number') }}</dt>
            <dd class="col-sm-8">{{ $student->admission_number }}</dd>
        </dl>
        <dl class="row">
            <dt class="col-sm-4">{{ trans('students::student.admitted_on') }}</dt>
            <dd class="col-sm-8">{{ formatDate(toUserTz($student->admitted_on)) }}</dd>
        </dl>
        <dl class="row">
            <dt class="col-sm-4">{{ trans('students::student.name') }}</dt>
            <dd class="col-sm-8">{{ $student->name }}</dd>
        </dl>
        <dl class="row">
            <dt class="col-sm-4">{{ trans('students::student.date_of_birth') }}</dt>
            <dd class="col-sm-8">{{ $student->date_of_birth }}</dd>
        </dl>
        <dl class="row">
            <dt class="col-sm-4">{{ trans('students::student.student_category') }}</dt>
            <dd class="col-sm-8">{{ $student->student_category->name }}</dd>
        </dl>
    </div>

@endsection