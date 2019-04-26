@extends('dashboard::layouts.tab_view')

@section('title', trans('students::student.edit_student'))

@section('breadcrumbs')

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
          <a href="{{ route('students.list') }}">{{ trans('students::student.students') }}</a>
      </li>
      <li class="breadcrumb-item">
          <a href="{{ route('student.account.view', $student->id) }}">{{ $student->name }}</a>
      </li>
      <li class="breadcrumb-item active">{{ trans('students::student.edit_student') }}</li>
    </ol>

@endsection

@section('tabs')

    @include('students::partials.edit_student_tabs')

@endsection

@section('tab')

<form class="form-horizontal" method="POST" id="edit-account-form" action="{{ route('student.account.edit', $student->id) }}">

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::student.email') }}</label>
            <div class="col-sm-8">
                <input type="email" name="email" class="form-control" placeholder="name@example.com" value="{{ $student->email }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::student.password') }}</label>
            <div class="col-sm-8">
                <input type="password" name="password" class="form-control">
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-6">
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-primary">{{ trans('base::common.save') }}</button>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

</form>

@endsection