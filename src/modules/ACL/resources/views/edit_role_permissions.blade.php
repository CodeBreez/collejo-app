@extends('collejo::dash.sections.tab_view')

@section('title', $role ? trans('acl::role.edit_role_permissions', ['role' => $role->name]) : trans('acl::role.new_role'))

@section('breadcrumbs')

@if($role)

<ol class="breadcrumb">
  <li><a href="{{ route('roles.list') }}">{{ trans('acl::role.roles') }}</a></li>
  <li class="active">{{ trans('acl::role.edit_role') }}</li>
</ol>

@endif

@endsection

@section('scripts')

<script type="text/javascript">
C.ready(function(){
	$('.chk-permission').change(function(){
		try{
			if ($(this).is(':checked')) {
				$(this).closest('ul').siblings('.checkbox-row').find('.chk-permission').prop('checked', true).trigger('change');
			} else {
				$(this).closest('li').find('.chk-permission').not($(this)).prop('checked', false);
			}
		}catch(e){}
	});

    $('#permissions-form').validate({
        submitHandler: function(form){
            $(form).ajaxSubmit({
                dataType:  'json',
                beforeSubmit:Collejo.form.lock(form),
                success: function(){
                    Collejo.form.unlock(form);
                },
                error:function(){
                    Collejo.form.unlock(form);
                }
            });
        }
    });
});
</script>

@endsection

@section('tabs')

    @include('acl::partials.edit_role_tabs')

@endsection

@section('tab')

	<form action="{{ route('role.permissions.edit', [$role->id, $module->name]) }}" method="POST" id="permissions-form">

		<ul class="list-unstyled">

			@foreach($module->permissions->where('parent_id', null) as $permission)
			
				<div class="col-md-4">
				
					@include('acl::partials.permission_row')

				</div>

			@endforeach

		</ul>


	    <div class="clearfix"></div>

        <button type="submit" class="btn btn-primary btn-lg pull-right" data-loading-text="{{ trans('common.saving') }}">{{ trans('common.save') }}</button>

    </form>

@endsection