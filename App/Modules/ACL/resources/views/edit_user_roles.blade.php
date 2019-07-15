@extends('dashboard::layouts.tab_view')

@section('title', $user->name)

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/acl/js/editUserRoles.js') }}"></script>
@endsection

@section('breadcrumbs')

    @if($user)

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a
                        href="{{ route('users.manage') }}">{{ trans('acl::user.users') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.details.edit', $user->id) }}">{{ $user->name }}</a>
            </li>
            <li class="breadcrumb-item active">{{ trans('acl::user.edit_user') }}</li>
        </ol>

    @endif

@endsection

@section('tabs')

    @include('acl::partials.edit_user_tabs')

@endsection

@section('tab')

    <div id="editUserRoles">
        <edit-user-roles
                :user="{{$user}}"
                :roles="{{$roles}}"></edit-user-roles>
    </div>

@endsection