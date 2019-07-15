@extends('dashboard::layouts.tab_view')

@section('title', trans('acl::user.account_details'))

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/acl/js/editUserAccount.js') }}"></script>
@endsection

@section('breadcrumbs')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                    href="{{ route('users.manage') }}">{{ trans('acl::user.users') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.details.view', $user->id) }}">{{ $user->name }}</a>
        </li>
        <li class="breadcrumb-item active">{{ trans('acl::user.account_details') }}</li>
    </ol>

@endsection

@section('tabs')

    @include('acl::partials.edit_user_tabs')

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