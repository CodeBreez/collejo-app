@extends('dashboard::layouts.tab_view')

@section('title', trans('students::student.edit_student'))

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/acl/js/editUserAccount.js') }}"></script>
@endsection

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

    <div id="editUserAccount">
        <edit-user-account
                @if($user)
                :entity="{{collect($user)}}"
                @endif
                :validation="{{$user_form_validator->renderRules()}}">

        </edit-user-account>
    </div>

@endsection