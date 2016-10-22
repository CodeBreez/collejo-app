<script type="text/javascript">
C.ready(function(){

    $('#edit-class').validate({
        rules:{!! $class_form_validator->renderRules() !!},
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
    <form method="POST" id="edit-class" class="form-horizontal" action="{{ $class ? route('grade.class.edit', ['grade' => $grade->id, 'class' => $class->id]) : route('grade.class.new', $grade->id) }}?target=classes">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Add New Class</h4>
        </div>
        <div class="modal-body"> 

                <div class="form-group">
                    <label class="col-sm-4 control-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" placeholder="Grade x Class x" value="{{ $class ? $class->name : '' }}">
                    </div>
                </div>               

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-lg btn-primary">Save</button>
                    </div>
                </div>

        </div>

    </form>

</div>