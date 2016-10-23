<div class="col-xs-6 address-block" id="address-{{ $address->id }}">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3"><label>{{ trans('employees::address.name') }}</label></div>
                <div class="col-xs-9">{{ $address->full_name }}</div>
            </div>
            <div class="row">
                <div class="col-xs-3"><label>{{ trans('employees::address.address') }}</label></div>
                <div class="col-xs-9">{{ $address->address }}</div>
            </div>            
            <div class="row">
                <div class="col-xs-3"><label>{{ trans('employees::address.city') }}</label></div>
                <div class="col-xs-9">{{ $address->city }}</div>
            </div>            
            <div class="row">
                <div class="col-xs-3"><label>{{ trans('employees::address.postal_code') }}</label></div>
                <div class="col-xs-9">{{ $address->postal_code }}</div>
            </div>            
            <div class="row">
                <div class="col-xs-3"><label>{{ trans('employees::address.phone') }}</label></div>
                <div class="col-xs-9">{{ $address->phone }}</div>
            </div>            
            <div class="row">
                <div class="col-xs-3"><label>{{ trans('employees::address.notes') }}</label></div>
                <div class="col-xs-9">{{ $address->note }}</div>
            </div>
        </div>
        <div class="panel-footer">
            @if($address->is_emergency)
                <span class="label label-danger">{{ trans('employees::address.emergency') }}</span>
            @else
                <span class="label"> </span>
            @endif
            <div class="tools-footer">
                <a data-toggle="ajax-modal" data-modal-backdrop="static" data-modal-keyboard="false" href="{{ route('employee.address.edit', [$employee->id, $address->id]) }}" class="btn btn-xs btn-default pull-left"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
                <a data-success-callback="afterDeleteAddress" data-toggle="ajax-link" data-confirm="{{ trans('common.delete_confirm') }}" href="{{ route('employee.address.delete', [$employee->id, $address->id]) }}" class="btn btn-xs btn-danger pull-left"><i class="fa fa-trash"></i> {{ trans('common.delete') }} </a>
            </div>
        </div>
    </div>
</div>