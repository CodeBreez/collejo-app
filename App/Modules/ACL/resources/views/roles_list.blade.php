@extends('dashboard::layouts.table_view')

@section('title', trans('acl::role.roles'))

@section('total', $roles->total())

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/acl/js/rolesList.js') }}"></script>
@endsection

@section('tools')

    @can('add_edit_role')

        <a href="{{ route('role.new') }}" class="btn btn-primary"><i
                    class="fa fa-fw fa-plus"></i> {{ trans('acl::role.new_role') }}</a>

    @endcan

@endsection

@section('table')
    <div id="rolesList">
        <roles-list
                @if($roles->count())
                :roles="{{$roles->toJson()}}"
                @endif
        ></roles-list>
    </div>

@endsection