@extends('collejo::dash.sections.table_view')

@section('title', trans('acl::role.roles'))

@section('tools')

@can('add_edit_role')
    <a href="{{ route('role.new') }}" data-toggle="ajax-modal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('acl::role.create_role') }}</a>  
@endcan

@endsection

@section('table')

<script type="text/javascript">
function afterRoleChange(){
    location.reload();
}
</script>

<table class="table" id="roles">
                
    <tr>
        <th width="10%">{{ trans('acl::role.name') }}</th>
        <th width="*">{{ trans('acl::role.permissions') }}</th>
        <th width="20%"></th>
    </tr>

    @foreach($roles as $role)

    <tr>
        <td>
            <a href="{{ route('role.permissions.edit', [$role->id, $module->name]) }}">
            @if($role->trashed())
                <span class="text-muted">{{ $role->name }}</span>
            @else
                {{ $role->name }}
            @endif
            </a>
        </td>
        <td>
            @foreach($role->permissions as $permission)
                <span class="label label-default">{{ $permission->name }}</span>
            @endforeach
        </td>
        <td class="tools-column">

            @can('add_edit_role')

                @if(!in_array($role->role, app()->majorUserRoles))

                    
                    @if($role->trashed())
                        <a href="{{ route('role.enable', $role->id) }}" data-toggle="ajax-link" data-confirm="{{ trans('acl::role.enable_confirm') }}" data-success-callback="afterRoleChange" class="btn btn-xs btn-warning"><i class="fa fa-fw fa-edit"></i>{{ trans('common.enable') }}</a>
                    @else
                        <a href="{{ route('role.disable', $role->id) }}" data-toggle="ajax-link" data-confirm="{{ trans('acl::role.disable_confirm') }}" data-success-callback="afterRoleChange" class="btn btn-xs btn-danger"><i class="fa fa-fw fa-edit"></i>{{ trans('common.disable') }}</a>
                    @endif
                    
                    
                @endif

                <a href="{{ route('role.permissions.edit', [$role->id, $module->name]) }}" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('acl::role.edit_permissions') }}</a>

            @endcan

        </td>
    </tr>

    @endforeach

</table>

<div class="pagination-row">{{ $roles->render() }}</div>

@endsection

