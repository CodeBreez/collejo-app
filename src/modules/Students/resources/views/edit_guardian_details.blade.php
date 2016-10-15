@extends('collejo::dash.sections.tab_view')

@section('title', $guardian ? trans('students::guardian.edit_guardian') : trans('students::guardian.new_guardian'))

@section('breadcrumbs')

@if($guardian)

<ol class="breadcrumb">
  <li><a href="{{ route('guardians.list') }}">{{ trans('students::guardian.guardians_list') }}</a></li>
  <li><a href="{{ route('guardian.details.view', $guardian->id) }}">{{ $guardian->name }}</a></li>
  <li class="active">{{ trans('students::guardian.edit_guardian') }}</li>
</ol>

@endif

@endsection

@section('scripts')

<script type="text/javascript">
$(function(){
    $('#edit-details-form').validate({
        rules:{!! $guardian_form_validator->renderRules() !!},
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

<form class="form-horizontal" method="POST" id="edit-details-form" action="{{ route('guardian.details.edit', $guardian->id) }}">

    @if($guardian)
        <input type="hidden" name="gid" value="{{ $guardian->id }}">
        <input type="hidden" name="uid" value="{{ $guardian->user->id }}">
    @endif

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::guardian.ssn') }}</label>
            <div class="col-sm-8">
                <input type="text" name="ssn" class="form-control" value="{{ $guardian ? $guardian->ssn : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::guardian.first_name') }}</label>
            <div class="col-sm-8">
                <input type="text" name="first_name" class="form-control" placeholder="Jon" value="{{ $guardian ? $guardian->first_name : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::guardian.last_name') }}</label>
            <div class="col-sm-8">
                <input type="text" name="last_name" class="form-control" placeholder="Doe" value="{{ $guardian ? $guardian->last_name : '' }}">
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