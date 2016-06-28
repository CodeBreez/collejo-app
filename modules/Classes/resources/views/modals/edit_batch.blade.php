<script type="text/javascript">
$(function(){

    $('#edit-batch').validate({
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
    <form method="POST" id="edit-batch" class="form-horizontal" action="{{ $batch ? route('classes.batch.edit', ['batch' => $batch->id]) : route('classes.batch.new') }}?target=batches">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Add New Batch</h4>
        </div>
        <div class="modal-body"> 

                <div class="form-group">
                    <label class="col-sm-4 control-label">Contact Person</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" placeholder="Jon Doe" value="{{ $batch ? $batch->name : '' }}">
                    </div>
                </div>               
                <div class="form-group">
                    <label class="col-sm-4 control-label">Start Date</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" name="start_date" class="form-control" data-toggle="date-input" value="{{ $batch ? $batch->start_date : '' }}">
                            <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">End Date</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" name="end_date" class="form-control" data-toggle="date-input" value="{{ $batch ? $batch->end_date : '' }}">
                            <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-6">
                        <button type="submit" class="btn btn-lg btn-primary">Save</button>
                    </div>
                </div>

        </div>

    </form>

</div>