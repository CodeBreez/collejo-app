@extends('dashboard::layouts.table_view')

@section('title', trans('acl::user.users'))

@section('total', $users->total())

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/acl/js/usersList.js') }}"></script>
@endsection

@section('tools')

    @can('create_user_accounts')

        <a href="{{ route('user.new') }}" class="btn btn-primary"><i
                    class="fa fa-fw fa-plus"></i> {{ trans('acl::user.new_user') }}</a>

    @endcan

@endsection

@section('table')
    <div id="usersList">
        <users-list
                @if($users->count())
                :users="{{$users->toJson()}}"
                @endif
        ></users-list>
    </div>

@endsection