@extends('dashboard::layouts.tab_view')

@section('title', $user->name)

@section('tools')

    @can('edit_user_account_info')

        <a href="{{ route('user.roles.edit', $user->id) }}" class="btn btn-primary"><i
                    class="fa fa-fw fa-edit"></i> {{ trans('base::common.edit') }}</a>

    @endcan

@endsection

@section('tabs')

    @include('acl::partials.view_user_tabs')

@endsection

@section('tab')

    <div class="col-sm-12">
        <dl class="row">

            @foreach($user->roles as $role)

                <dt class="col-sm-2">{{ $role->name }}</dt>

                <span class="col-sm-10">

                @foreach($role->permissions as $permission)

                        <span class="badge badge-secondary">{{ $permission->name }}</span>

                @endforeach

                </span>
            @endforeach
        </dl>
    </div>

@endsection