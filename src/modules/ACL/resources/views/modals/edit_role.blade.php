<script type="text/javascript">
C.ready(function(){

    $('#role-form').validate({
        rules:{!! $role_form_validator->renderRules() !!},
        submitHandler: function(form){
            $(form).ajaxSubmit({
                dataType:  'json',
                beforeSubmit:Collejo.form.lock(form),
                success: function(){
                    Collejo.modal.close(form);
                },
                error:function(){
                    Collejo.form.unlock(form);
                }
            });
        }
    });

    $('#role-name').keyup(function(){
        $('#role-name').val($('#role-name').val().replace(/[^\w\s!?]/g,''));
    });
}); 
</script>

<div class="modal-content">
    <form method="POST" id="role-form" class="form-horizontal" action="{{ $role ? route('role.edit', $role->id) : route('role.new') }}?target=roles">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ trans('acl::role.new_role') }}</h4>
        </div>
        <div class="modal-body"> 
  
                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('acl::role.name') }}</label>
                    <div class="col-sm-6">
                        <input type="text" name="role" class="form-control" id="role-name">
                    </div>
                </div>             

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-lg btn-primary" data-loading-text="{{ trans('common.saving') }}">{{ trans('common.save') }}</button>
                    </div>
                </div>

        </div>

    </form>

</div>