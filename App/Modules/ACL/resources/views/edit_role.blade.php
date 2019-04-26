@extends('dashboard::layouts.tab_view')

@section('title', trans('acl::role.role_details'))

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/acl/js/editRole.js') }}"></script>
@endsection

@section('breadcrumbs')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('permissions.manage') }}">{{ trans('acl::role.roles') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ $role->name }}</li>
    </ol>

@endsection

@section('tabs')

    @include('acl::partials.edit_role_tabs')

@endsection

@section('tab')

    <div id="editRole">
        <edit-role
                @if($role)
                :entity="{{collect($role)}}"
                @endif
                :permissions="{{collect($permissions)}}"
                :validation="{{$role_form_validator->renderRules()}}">

        </edit-role>
    </div>

@endsection