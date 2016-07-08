<script type="text/javascript">
$(function(){

    $('#edit-term').validate({
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
    <form method="POST" id="edit-term" class="form-horizontal" action="{{ $term ? route('batch.term.edit', [$batch->id, $term->id]) : route('batch.term.new', $batch->id) }}?target=addreses">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Add New Term</h4>
        </div>
        <div class="modal-body"> 

                <div class="form-group">
                    <label class="col-sm-4 control-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" placeholder="Summer" value="{{ $term ? $term->name : '' }}">
                    </div>
                </div>               
                <div class="form-group">
                    <label class="col-sm-4 control-label">Start Date</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="text" name="start_date" class="form-control" data-toggle="date-input" value="{{ $term ? $term->start_date : '' }}">
                            <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                        </div>
                    </div>
                </div>             
                <div class="form-group">
                    <label class="col-sm-4 control-label">End Date</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="text" name="end_date" class="form-control" data-toggle="date-input" value="{{ $term ? $term->end_date : '' }}">
                            <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                        </div>
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