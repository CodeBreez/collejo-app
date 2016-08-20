@extends('collejo::dash.sections.table_view')

@section('title', trans('acl::role.roles'))

@section('tools')

<a href="{{ route('batch.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('acl::role.create_role') }}</a>  

@endsection

@section('table')

<table class="table">
                
    <tr>
        <th width="30%">{{ trans('acl::role.name') }}</th>
        <th width="30%">{{ trans('acl::role.description') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($roles as $role)

    <tr>
        <td>{{ $role->name }}</td>
        <td>
            <div><a href="{{ route('batch.details.view', $role->id) }}">{{ $role->description }}</a></div>
        </td>
        <td class="tools-column">
            <a href="{{ route('batch.details.edit', $role->id) }}" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
        </td>
    </tr>

    @endforeach

</table>

<div class="pagination-row">{{ $roles->render() }}</div>

@endsection

