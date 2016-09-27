@extends('collejo::dash.sections.table_view')

@section('title', trans('acl::role.roles'))

@section('tools')

@can('add_edit_role')
    <a href="{{ route('role.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('acl::role.create_role') }}</a>  
@endcan

@endsection

@section('table')

<table class="table">
                
    <tr>
        <th width="10%">{{ trans('acl::role.name') }}</th>
        <th width="*">{{ trans('acl::role.permissions') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($roles as $role)

    <tr>
        <td>
            <a href="{{ route('role.permissions.edit', [$role->id, $module->name]) }}">{{ $role->name }}</a></td>
        <td>
            @foreach($role->permissions as $permission)
                <span class="label label-default">{{ $permission->name }}</span>
            @endforeach
        </td>
        <td class="tools-column">
            @can('add_edit_role')
                <a href="{{ route('role.permissions.edit', [$role->id, $module->name]) }}" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
            @endcan
        </td>
    </tr>

    @endforeach

</table>

<div class="pagination-row">{{ $roles->render() }}</div>

@endsection

