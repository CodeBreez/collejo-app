@extends('collejo::dash.sections.tab_view')

@section('title', trans('students::guardian.edit_guardian'))

@section('breadcrumbs')

<ol class="breadcrumb">
  <li><a href="{{ route('guardians.list') }}">{{ trans('students::guardian.guardians_list') }}</a></li>
  <li><a href="{{ route('guardian.account.view', $guardian->id) }}">{{ $guardian->name }}</a></li>
  <li class="active">{{ trans('students::guardian.edit_guardian') }}</li>
</ol>

@endsection

@section('scripts')

<script type="text/javascript">
$(function(){
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

    @include('students::partials.edit_guardian_tabs')

@endsection

@section('tab')

<form class="form-horizontal" method="POST" id="edit-account-form" action="{{ route('guardian.account.edit', $guardian->id) }}">

    <input type="hidden" name="sid" value="{{ $guardian->id }}">
    <input type="hidden" name="uid" value="{{ $guardian->user->id }}">

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::guardian.email') }}</label>
            <div class="col-sm-8">
                <input type="email" name="email" class="form-control" placeholder="name@example.com" value="{{ $guardian->email }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::guardian.password') }}</label>
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