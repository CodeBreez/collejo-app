@extends('dashboard::layouts.tab_view')

@section('title', $user ? trans('acl::user.edit_user') : trans('acl::user.new_user'))

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/acl/js/editUserDetails.js') }}"></script>
@endsection

@section('breadcrumbs')

    @if($user)

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a
                        href="{{ route('users.manage') }}">{{ trans('acl::user.users') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.details.view', $user->id) }}">{{ $user->name }}</a>
            </li>
            <li class="breadcrumb-item active">{{ trans('acl::user.edit_user') }}</li>
        </ol>

    @endif

@endsection

@section('tabs')

    @include('acl::partials.edit_user_tabs')

@endsection

@section('tab')

    <div id="editUserDetails">
        <edit-user-details
                @if($user)
                :entity="{{$user}}"
                @endif
                :validation="{{$user_form_validator->renderRules()}}">

        </edit-user-details>
    </div>

@endsection