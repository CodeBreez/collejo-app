<script type="text/javascript">
C.ready(function(){

    $('#edit-employee-category').validate({
        rules:{!! $category_form_validator->renderRules() !!},
        submitHandler: function(form){
            $(form).ajaxSubmit({
                dataType:'json',
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
    <form method="POST" id="edit-employee-category" class="form-horizontal" action="{{ $employee_category ? route('employee_category.edit', $employee_category->id) : route('employee_category.new') }}?target=employee_categories">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ $employee_category ? trans('employees::employee_category.new_employee_category') : trans('employees::employee_category.edit_employee_category') }}</h4>
        </div>
        <div class="modal-body"> 

                @if($employee_category)
                    <input type="hidden" name="ecid" value="{{ $employee_category->id }}">
                @endif

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('employees::employee_category.name') }}</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" placeholder="Visiting Lecturers" value="{{ $employee_category ? $employee_category->name : '' }}">
                    </div>
                </div>               
                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('employees::employee_category.code') }}</label>
                    <div class="col-sm-8">
                        <input type="text" name="code" class="form-control" placeholder="VIS" value="{{ $employee_category ? $employee_category->code : '' }}">
                    </div>
                </div>                

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary btn-lg" data-loading-text="{{ trans('common.saving') }}">{{ trans('common.save') }}</button>
                    </div>
                </div>

        </div>

    </form>

</div>