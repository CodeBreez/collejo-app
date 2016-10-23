@extends('collejo::dash.sections.tab_view')

@section('title', trans('employees::employee.edit_employee'))

@section('breadcrumbs')

<ol class="breadcrumb">
  <li><a href="{{ route('employees.list') }}">{{ trans('employees::employee.employees_list') }}</a></li>
  <li><a href="{{ route('employee.account.view', $employee->id) }}">{{ $employee->name }}</a></li>
  <li class="active">{{ trans('employees::employee.edit_employee') }}</li>
</ol>

@endsection

@section('scripts')

<script type="text/javascript">
C.ready(function(){
    $('#edit-account-form').validate({
        rules:{!! $account_form_validator->renderRules() !!},
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

    @include('employees::partials.edit_employee_tabs')

@endsection

@section('tab')

<form class="form-horizontal" method="POST" id="edit-account-form" action="{{ route('employee.account.edit', $employee->id) }}">

    <input type="hidden" name="sid" value="{{ $employee->id }}">
    <input type="hidden" name="uid" value="{{ $employee->user->id }}">

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('employees::employee.email') }}</label>
            <div class="col-sm-8">
                <input type="email" name="email" class="form-control" placeholder="name@example.com" value="{{ $employee->email }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('employees::employee.password') }}</label>
            <div class="col-sm-8">
                <input type="password" name="password" class="form-control">
            </div>
        </div>
    </div>  


    <div class="clearfix"></div>

    <div class="col-xs-6">
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-primary btn-lg" data-loading-text="{{ trans('common.saving') }}">{{ trans('common.save') }}</button>
            </div>
        </div>
    </div>
    
    <div class="clearfix"></div>

</form>

@endsection