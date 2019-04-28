@extends('dashboard::layouts.tab_view')

@section('title', trans('students::guardian.edit_guardian'))

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/acl/js/editUserAccount.js') }}"></script>
@endsection

@section('breadcrumbs')

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
          <a href="{{ route('guardians.list') }}">{{ trans('students::guardian.guardians') }}</a>
      </li>
      <li class="breadcrumb-item">
          <a href="{{ route('guardian.account.view', $guardian->id) }}">{{ $guardian->name }}</a>
      </li>
      <li class="breadcrumb-item active">{{ trans('students::guardian.edit_guardian') }}</li>
    </ol>

@endsection

@section('tabs')

    @include('students::guardian.edit_guardian_tabs')

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