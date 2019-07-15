@extends('dashboard::layouts.tab_view')

@section('title', $grade->name)

@section('tools')

    @can('add_edit_class')
        <a href="{{ route('grade.classes.edit', $grade->id) }}" class="btn btn-primary">
            <i class="fa fa-fw fa-edit"></i> {{ trans('base::common.edit') }}
        </a>
    @endcan

@endsection

@section('tabs')

    @include('classes::partials.view_grade_tabs')

@endsection

@section('tab')

    <div class="card-group">

        @foreach($grade->classes as $class)

            <div class="card">
                <div class="card-header">{{ $class->name }}</div>
                <div class="card-block">

                </div>
            </div>

        @endforeach

    </div>

@endsection