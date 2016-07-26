<script type="text/javascript">
$(function(){

    $('#edit-employee-grade').validate({
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
    <form method="POST" id="edit-employee-grade" class="form-horizontal" action="{{ $employee_grade ? route('employee_grade.edit', $employee_grade->id) : route('employee_grade.new') }}?target=employee_grades">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ $employee_grade ? trans('employees::employee_grade.edit_employee_grade') : trans('employees::employee_grade.new_employee_grade') }}</h4>
        </div>
        <div class="modal-body"> 

                @if($employee_grade)
                    <input type="hidden" name="egid" value="{{ $employee_grade->id }}">
                @endif

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('employees::employee_grade.name') }}</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" placeholder="Visiting Lecturers" value="{{ $employee_grade ? $employee_grade->name : '' }}">
                    </div>
                </div>               
                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('employees::employee_grade.code') }}</label>
                    <div class="col-sm-8">
                        <input type="text" name="code" class="form-control" placeholder="VIS" value="{{ $employee_grade ? $employee_grade->code : '' }}">
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