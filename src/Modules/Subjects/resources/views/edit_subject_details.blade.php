@extends('collejo::dash.sections.tab_view')

@section('title', trans('subjects::subject.new'))

@section('scripts')

<script type="text/javascript">
C.ready(function(){
    $('#edit-subject-form').validate({
        rules:{!! $subject_form_validator->renderRules() !!},
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

    @include('subjects::partials.edit_subject_tabs')

@endsection

@section('tab')

<form class="form-horizontal" method="POST" id="edit-subject-form" action="{{ route('subject.new') }}">

    @if($subject)
        <input type="hidden" name="gid" value="{{ $subject->id }}">
    @endif

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('subjects::subject.name') }}</label>
            <div class="col-sm-8">
                <input type="text" name="name" class="form-control" value="{{ $subject ? $subject->name : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('subjects::subject.code') }}</label>
            <div class="col-sm-8">
                <input type="text" name="code" class="form-control" value="{{ $subject ? $subject->code : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('subjects::subject.priority') }}</label>
            <div class="col-sm-8">
                <input type="text" name="priority" class="form-control" value="{{ $subject ? $subject->priority : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('subjects::subject.max_sessions_per_day') }}</label>
            <div class="col-sm-8">
                <input type="text" name="max_sessions_per_day" class="form-control" value="{{ $subject ? $subject->max_sessions_per_day : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('subjects::subject.max_sessions_per_week') }}</label>
            <div class="col-sm-8">
                <input type="text" name="max_sessions_per_week" class="form-control" value="{{ $subject ? $subject->max_sessions_per_week : '' }}">
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