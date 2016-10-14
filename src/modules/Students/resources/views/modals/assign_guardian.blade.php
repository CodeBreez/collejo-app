<script type="text/javascript">
$(function(){

    $('#assign-guardian').validate({
        rules:{!! $assign_form->renderRules() !!},
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
}); 
</script>

<div class="modal-content">
    <form method="POST" id="assign-guardian" class="form-horizontal" action="{{ route('student.assign_guardian', $student->id) }}?target={{ Request::get('target', 'students') }}">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ trans('students::student.assign_guardian') }}</h4>
        </div>
        <div class="modal-body"> 

            <input type="hidden" name="student_id" value="{{ $student->id }}">

            <div class="form-group">
                <label class="col-sm-4 control-label">{{ trans('students::student.find_guardians') }}</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <select class="form-control" data-toggle="search-dropdown" data-url="{{ route('guardians.search') }}" name="guardian_id" id="guardian-sel">
                        </select>
                        <span class="input-group-btn"><a href="{{ route('guardian.new') }}" class="btn btn-default" data-toggle="ajax-modal"><i class="fa fa-fw fa-plus"></i></a></span>
                    </div>
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