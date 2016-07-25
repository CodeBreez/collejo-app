@extends('collejo::dash.sections.tab_view')

@section('title', $employee ? trans('employees::employee.edit_employee') : trans('employees::employee.new_employee'))

@section('breadcrumbs')

@if($employee)

<ol class="breadcrumb">
  <li><a href="{{ route('employees.list') }}">{{ trans('employees::employee.employees_list') }}</a></li>
  <li><a href="{{ route('employee.details.view', $employee->id) }}">{{ $employee->name }}</a></li>
  <li class="active">{{ trans('employees::employee.edit_employee') }}</li>
</ol>

@endif

@endsection

@section('scripts')

<script type="text/javascript">
$(function(){
    $('#edit-details-form').validate({
        submitHandler: function(form){
            $(form).ajaxSubmit({
                dataType:  'json',
                beforeSubmit:Collejo.form.lock(form),
                success: function(response){
                    Collejo.form.unlock(form);                   
                },
                error:function(){
                    Collejo.form.unlock(form);
                }
            });
        }
    });
});    
</script>

@endsection

@section('tabs')

    @include('employees::partials.edit_tabs')

@endsection

@section('tab')

<form class="form-horizontal" method="POST" id="edit-details-form" action="{{ $employee ? route('employee.details.edit', $employee->id) : route('employee.new') }}">

    @if($employee)
        <input type="hidden" name="sid" value="{{ $employee->id }}">
        <input type="hidden" name="uid" value="{{ $employee->user->id }}">
    @endif

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('employees::employee.picture') }}</label>
            <div class="col-sm-8">
                {{ Uploader::renderUploader() }}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('employees::employee.employee_number') }}</label>
            <div class="col-sm-8">
                <input type="text" name="employee_number" class="form-control" value="{{ $employee ? $employee->employee_number : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('employees::employee.joined_on') }}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" name="joined_on" class="form-control" data-toggle="date-input" value="{{ $employee ? formatDate(toUserTz($employee->joined_on)) : '' }}">
                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('employees::employee.employee_category') }}</label>
            <div class="col-sm-8">
                <select name="employee_category_id" class="form-control" data-toggle="select-dropdown">
                    @foreach($employee_categories as $employee_category)
                        <option></option>
                        @if($employee && $employee_category->id == $employee->employee_category_id)
                            <option selected value="{{ $employee_category->id }}">{{ $employee_category->name }}</option>
                        @else
                            <option value="{{ $employee_category->id }}">{{ $employee_category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>                        
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('employees::employee.first_name') }}</label>
            <div class="col-sm-8">
                <input type="text" name="first_name" class="form-control" placeholder="Jon" value="{{ $employee ? $employee->first_name : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('employees::employee.last_name') }}</label>
            <div class="col-sm-8">
                <input type="text" name="last_name" class="form-control" placeholder="Doe" value="{{ $employee ? $employee->last_name : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('employees::employee.date_of_birth') }}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" name="date_of_birth" class="form-control" data-toggle="date-input" value="{{ $employee ? $employee->date_of_birth : '' }}">
                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                </div>
            </div>
        </div>
    </div>  


    <div class="clearfix"></div>

    <div class="col-xs-6">
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-10">
                <button type="submit" class="btn btn-primary btn-lg" data-loading-text="{{ trans('common.saving') }}">{{ trans('common.save') }}</button>
            </div>
        </div>
    </div>
    
    <div class="clearfix"></div>

</form>

@endsection