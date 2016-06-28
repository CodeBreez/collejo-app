<div class="col-xs-6 address-block" id="address-{{ $address->id }}">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3"><label>Name</label></div>
                <div class="col-xs-9">{{ $address->full_name }}</div>
            </div>
            <div class="row">
                <div class="col-xs-3"><label>Address</label></div>
                <div class="col-xs-9">{{ $address->address }}</div>
            </div>            
            <div class="row">
                <div class="col-xs-3"><label>City</label></div>
                <div class="col-xs-9">{{ $address->city }}</div>
            </div>            
            <div class="row">
                <div class="col-xs-3"><label>Postal Code</label></div>
                <div class="col-xs-9">{{ $address->postal_code }}</div>
            </div>            
            <div class="row">
                <div class="col-xs-3"><label>Phone</label></div>
                <div class="col-xs-9">{{ $address->phone }}</div>
            </div>            
            <div class="row">
                <div class="col-xs-3"><label>Notes</label></div>
                <div class="col-xs-9">{{ $address->note }}</div>
            </div>
        </div>
        <div class="panel-footer">
            @if($address->is_emergency)
                <span class="label label-danger">Emergency</span>
            @else
                <span class="label"> </span>
            @endif
            <div class="tools-footer">
                <a data-toggle="ajax-modal" data-modal-backdrop="static" data-modal-keyboard="false" href="{{ route('students.edit.address.edit', ['id' => $student->id, 'cid' => $address->id]) }}" class="btn btn-xs btn-default pull-left"><i class="fa fa-edit"></i> Edit</a>
                <a data-success-callback="afterDeleteAddress" data-toggle="ajax-link" data-confirm="Delete this?" href="{{ route('students.edit.address.delete', ['id' => $student->id, 'cid' => $address->id]) }}" class="btn btn-xs btn-danger pull-left"><i class="fa fa-trash"></i> Delete</a>
            </div>
        </div>
    </div>
</div>