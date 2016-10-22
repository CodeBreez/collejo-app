<script type="text/javascript">
$(function(){

    $('#edit-employee-department').validate({
        rules:{!! $department_form_validator->renderRules() !!},
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
    <form method="POST" id="edit-employee-department" class="form-horizontal" action="{{ $employee_department ? route('employee_department.edit', $employee_department->id) : route('employee_department.new') }}?target=employee_departments">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ $employee_department ? trans('employees::employee_department.edit_employee_department') : trans('employees::employee_department.new_employee_department') }}</h4>
        </div>
        <div class="modal-body"> 

                @if($employee_department)
                    <input type="hidden" name="edid" value="{{ $employee_department->id }}">
                @endif

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('employees::employee_department.name') }}</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" placeholder="Science Department" value="{{ $employee_department ? $employee_department->name : '' }}">
                    </div>
                </div>               
                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('employees::employee_department.code') }}</label>
                    <div class="col-sm-8">
                        <input type="text" name="code" class="form-control" placeholder="SCI" value="{{ $employee_department ? $employee_department->code : '' }}">
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