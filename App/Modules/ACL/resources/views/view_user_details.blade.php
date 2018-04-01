@extends('dashboard::layouts.tab_view')

@section('title', $user->name)

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('users.manage') }}">{{ trans('acl::user.users') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ trans('acl::user.user_details') }}</li>
    </ol>
@endsection

@section('tabs')

    @include('acl::partials.view_user_tabs')

@endsection

@section('tab')

    <div class="col-sm-6">
        <dl class="row">
            <dt class="col-sm-4">{{ trans('acl::user.name') }}</dt>
            <dd class="col-sm-8">{{ $user->name }}</dd>

            <dt class="col-sm-4">{{ trans('acl::user.email') }}</dt>
            <dd class="col-sm-8">{{ $user->email }}</dd>

            <dt class="col-sm-4">{{ trans('acl::user.date_of_birth') }}</dt>
            <dd class="col-sm-8">{{ $user->date_of_birth }}</dd>
        </dl>
    </div>

@endsection