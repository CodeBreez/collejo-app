@extends('collejo::dash.sections.tab_view')

@section('title', $grade ? trans('classes::grade.edit_grade') : trans('classes::grade.new_grade'))

@section('breadcrumbs')

@if($grade)

<ol class="breadcrumb">
  <li><a href="{{ route('grades.list') }}">{{ trans('classes::grade.grades_list') }}</a></li>
  <li><a href="{{ route('grade.details.view', $grade->id) }}">{{ $grade->name }}</a></li>
  <li class="active">{{ trans('classes::grade.edit_grade') }}</li>
</ol>

@endif

@endsection

@section('scripts')

<script type="text/javascript">
C.ready(function(){

    $('#edit-grade').validate({
        rules:{!! $grade_form_validator->renderRules() !!},
        submitHandler: function(form){
            $(form).ajaxSubmit({
                dataType:  'json',
                beforeSubmit:Collejo.form.lock(form),
                success: function(){
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

    @include('classes::partials.edit_grade_tabs')

@endsection

@section('tab')

<form method="POST" id="edit-grade" class="form-horizontal" action="{{ $grade ? route('grade.details.edit', $grade->id) : route('grade.new') }}">

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('classes::grade.name') }}</label>
            <div class="col-sm-8">
                <input type="text" name="name" class="form-control" placeholder="{{ trans('classes::grade.name_placeholder') }}" value="{{ $grade ? $grade->name : '' }}">
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