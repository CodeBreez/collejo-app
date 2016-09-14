<script type="text/javascript">
$(function(){

    $('#assign-class').validate({
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

    var batch = Collejo.components.dropDown($('#batch'));
    var grade = Collejo.components.dropDown($('#grade'));
    var cls = Collejo.components.dropDown($('#class'));

    batch.on('change', function(value){
        Collejo.templates.spinnerTemplate().addClass('inline').insertAfter($('#grade'));
        grade.disable();
        cls.disable();

        $.getJSON('{{ route('batch.grades.search') }}?batch_id=' + value, function(response){
            $('#grade').siblings('.spinner-wrap').remove();
            grade.enable();
            cls.enable();
            
            if (response.success) {
                grade.clear();
                grade.clearOptions();
                cls.clear();
                cls.clearOptions();

                $.each(response.data, function(value, text){
                    grade.addOption({value:value,text:text});
                });
            }
        });
    });

    grade.on('change', function(value){
        Collejo.templates.spinnerTemplate().addClass('inline').insertAfter($('#class'));
        cls.disable();

        $.getJSON('{{ route('grade.classes.search') }}?grade_id=' + value, function(response){
            $('#class').siblings('.spinner-wrap').remove();
            cls.enable();

            if (response.success) {
                cls.clear();
                cls.clearOptions();

                $.each(response.data, function(value, text){
                    cls.addOption({value:value,text:text});
                });
            }
        });
    });
    
}); 
</script>

<div class="modal-content">
    <form method="POST" id="assign-class" class="form-horizontal" action="{{ route('student.assign_class', $student->id) }}?target=students">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ trans('students::student.assign_class') }}</h4>
        </div>
        <div class="modal-body"> 

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('students::student.batch') }}</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="batch_id" id="batch">
                            <option></option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>      
                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('students::student.grade') }}</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="grade_id" id="grade">
                        </select>
                    </div>
                </div>       
                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('students::student.class') }}</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="class_id" id="class">
                        </select>
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