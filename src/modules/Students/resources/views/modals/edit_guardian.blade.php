<script type="text/javascript">
$(function(){
    $('#create-guardian').validate({
        rules:{!! $guradian_form_validator->renderRules() !!},
        submitHandler: function(form){
            $(form).ajaxSubmit({
                dataType:  'json',
                beforeSubmit:Collejo.form.lock(form),
                success: function(response){
                    if (response.success) {
                        var selectize = $('#guardian-sel')[0].selectize;
                        var guardian = response.data.guardian;

                        selectize.addOption({
                            name: guardian.name,
                            id: guardian.id
                        });
                        selectize.addItem(guardian.id);
                        selectize.setValue(guardian.id, true);

                        Collejo.modal.close(form);
                    }
                },
                error:function(){
                    Collejo.form.unlock(form);
                }
            });
        }
    });
}); 
</script>

<div class="modal-content">
    <form method="POST" id="create-guardian" class="form-horizontal" action="{{ route('guardian.new') }}?target=students">
    
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ trans('students::guardian.create_guardian') }}</h4>
        </div>
        <div class="modal-body"> 

            <div class="form-group">
                <label class="col-sm-4 control-label">{{ trans('students::guardian.first_name') }}</label>
                <div class="col-sm-8">
                    <input type="text" name="first_name" class="form-control" placeholder="Jon">
                </div>
            </div>            
            <div class="form-group">
                <label class="col-sm-4 control-label">{{ trans('students::guardian.last_name') }}</label>
                <div class="col-sm-8">
                    <input type="text" name="last_name" class="form-control" placeholder="Doe">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">{{ trans('students::guardian.ssn') }}</label>
                <div class="col-sm-8">
                    <input type="text" name="ssn" class="form-control" placeholder="XXXXXXXXX">
                </div>
            </div>  
            <div class="form-group">
                <label class="col-sm-4 control-label">{{ trans('students::guardian.email') }}</label>
                <div class="col-sm-8">
                    <input type="text" name="email" class="form-control" placeholder="name@example.com">
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