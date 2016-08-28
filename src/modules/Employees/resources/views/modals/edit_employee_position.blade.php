<script type="text/javascript">
$(function(){

    $('#edit-employee-positiion').validate({
        rules:{!! $position_form_validator->renderRules() !!},
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
    <form method="POST" id="edit-employee-positiion" class="form-horizontal" action="{{ $employee_position ? route('employee_position.edit', $employee_position->id) : route('employee_position.new') }}?target=employee_positions">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ $employee_position ? trans('employees::employee_position.new_employee_position') : trans('employees::employee_position.edit_employee_position') }}</h4>
        </div>
        <div class="modal-body"> 

                @if($employee_position)
                    <input type="hidden" name="epid" value="{{ $employee_position->id }}">
                @endif

                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('employees::employee_position.name') }}</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" placeholder="Senior Lecturer" value="{{ $employee_position ? $employee_position->name : '' }}">
                    </div>
                </div>               
                <div class="form-group">
                    <label class="col-sm-4 control-label">{{ trans('students::employee_position.employee_category') }}</label>
                    <div class="col-sm-8">
                        <select name="employee_category_id" class="form-control" data-toggle="select-dropdown">
                            @foreach($employee_categories as $employee_category)
                                <option></option>
                                @if($employee_position && $employee_category->id == $employee_position->employee_category_id)
                                    <option selected value="{{ $employee_category->id }}">{{ $employee_category->name }}</option>
                                @else
                                    <option value="{{ $employee_category->id }}">{{ $employee_category->name }}</option>
                                @endif
                            @endforeach
                        </select>
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