@extends('collejo::dash.sections.tab_view')

@section('title', $student->name)

@section('breadcrumbs')

<ol class="breadcrumb">
  <li><a href="{{ route('students.list') }}">{{ trans('students::student.students_list') }}</a></li>
  <li><a href="{{ route('student.addresses.view', $student->id) }}">{{ $student->name }}</a></li>
  <li class="active">{{ trans('students::student.edit_student') }}</li>
</ol>

@endsection

@section('tools')

<a href="{{ route('student.address.new', $student->id) }}" data-modal-backdrop="static" data-modal-keyboard="false" class="btn btn-primary pull-right" data-toggle="ajax-modal"><i class="fa fa-plus"></i> {{ trans('students::address.new_address') }}</a>  

@endsection

@section('tabs')

    @include('students::partials.edit_student_tabs')

@endsection

@section('tab')


<div id="addresses" class="column-list">

    <div class="columns">

        @foreach($student->addresses as $address)

            @include('students::partials.student_address')

        @endforeach

    </div>

    <div class="col-md-6">
        <div class="placeholder">{{ trans('students::address.empty_list') }}</div>
    </div>


</div>  

<div class="clearfix"></div>


@endsection