<script type="text/javascript">
$(function(){

    $('#edit-contact').validate({
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
    <form method="POST" id="edit-contact" class="form-horizontal" action="{{ $address ? route('students.edit.address.edit', ['student' => $student->id, 'address' => $address]) : route('students.edit.address.new', $student->id) }}?target=addreses">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Add New Contact</h4>
        </div>
        <div class="modal-body"> 

                <div class="form-group">
                    <label class="col-sm-4 control-label">Contact Person</label>
                    <div class="col-sm-8">
                        <input type="text" name="full_name" class="form-control" placeholder="Jon Doe" value="{{ $address ? $address->full_name : '' }}">
                    </div>
                </div>               
                <div class="form-group">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-8">
                        <input type="text" name="address" class="form-control" placeholder="No XXX, Cafe Street" value="{{ $address ? $address->address : '' }}">
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-8">
                        <input type="text" name="city" class="form-control" placeholder="London" value="{{ $address ? $address->city : '' }}">
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-4 control-label">Postal Code</label>
                    <div class="col-sm-8">
                        <input type="text" name="postal_code" class="form-control" placeholder="xxxx" value="{{ $address ? $address->postal_code : '' }}">
                    </div>
                </div>                  
                <div class="form-group">
                    <label class="col-sm-4 control-label">Phone</label>
                    <div class="col-sm-8">
                        <input type="text" name="phone" class="form-control" placeholder="xxxxxxxxxx" value="{{ $address ? $address->phone : '' }}">
                    </div>
                </div>                  
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox-row">
                            @if($address && $address->is_emergency)
                                <input type="checkbox" checked name="is_emergency" id="is-emergency">
                            @else
                                <input type="checkbox" name="is_emergency" id="is-emergency">
                            @endif
                            <label for="is-emergency"> </label> <span> Use this contact in case of an emergency</span>
                        </div>
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-4 control-label">Notes</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" name="note">{{ $address ? $address->note : '' }}</textarea>
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