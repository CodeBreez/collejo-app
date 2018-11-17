@extends('dashboard::layouts.tab_view')

@section('title', $student->name)

@section('tools')

<a href="{{ route('student.addresses.edit', $student->id) }}" class="btn btn-primary">
    <i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}
</a>

@endsection

@section('tabs')

    @include('students::partials.view_student_tabs')

@endsection

@section('tab')


<div id="addresses" class="column-list">

    <div class="columns">



    </div>

    <div class="col-md-6">
        <div class="placeholder">{{ trans('students::address.empty_list') }}</div>
    </div>


</div>

<div class="clearfix"></div>


@endsection