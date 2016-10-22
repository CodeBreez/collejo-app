@extends('collejo::dash.sections.tab_view')

@section('title', trans('students::student.edit_student'))

@section('breadcrumbs')

<ol class="breadcrumb">
  <li><a href="{{ route('students.list') }}">{{ trans('students::student.students_list') }}</a></li>
  <li><a href="{{ route('student.account.view', $student->id) }}">{{ $student->name }}</a></li>
  <li class="active">{{ trans('students::student.edit_student') }}</li>
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

    @include('students::partials.edit_student_tabs')

@endsection

@section('tab')

<form class="form-horizontal" method="POST" id="edit-account-form" action="{{ route('student.account.edit', $student->id) }}">

    <input type="hidden" name="sid" value="{{ $student->id }}">
    <input type="hidden" name="uid" value="{{ $student->user->id }}">

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::student.email') }}</label>
            <div class="col-sm-8">
                <input type="email" name="email" class="form-control" placeholder="name@example.com" value="{{ $student->email }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::student.password') }}</label>
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