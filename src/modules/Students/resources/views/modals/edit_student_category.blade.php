<script type="text/javascript">
C.ready(function(){

    $('#edit-student-category').validate({
        rules:{!! $category_form_validator->renderRules() !!},
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
    <form method="POST" id="edit-student-category" class="form-horizontal" action="{{ $student_category ? route('student_category.edit', $student_category->id) : route('student_category.new') }}?target=student_categories">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ trans('students::student_category.new_student_category') }}</h4>
        </div>
        <div class="modal-body"> 

                @if($student_category)
                    <input type="hidden" name="scid" value="{{ $student_category->id }}">
                @endif

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('students::student_category.name') }}</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" placeholder="Scholarship Holders" value="{{ $student_category ? $student_category->name : '' }}">
                    </div>
                </div>               
                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('students::student_category.code') }}</label>
                    <div class="col-sm-8">
                        <input type="text" name="code" class="form-control" placeholder="SCH" value="{{ $student_category ? $student_category->code : '' }}">
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