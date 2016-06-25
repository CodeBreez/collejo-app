<script type="text/javascript">
$(function(){

    $('#edit-contact').validate({
        submitHandler: function(form){
            $(form).ajaxSubmit({
                dataType:  'json',
                beforeSubmit:bw.lockform(form),
                success: function(response){
                },
                error: function(response){
                }
            });
        }
    });
    
}); 
</script>

<div class="modal-content">
    <form method="POST" id="edit-contact" action="{{ route('students.edit.contacts.new', $student->id) }}">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Add New Contact</h4>
        </div>
        <div class="modal-body"> 

            <div class="row">

                <div class="col-xs-3">
                    
                </div>
                <div class="col-xs-9">
                    
                </div>

            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-lg btn-primary">Save</button>
        </div>

    </form>

</div>