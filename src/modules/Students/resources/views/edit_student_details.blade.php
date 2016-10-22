@extends('collejo::dash.sections.tab_view')

@section('title', $student ? trans('students::student.edit_student') : trans('students::student.new_student'))

@section('breadcrumbs')

@if($student)

<ol class="breadcrumb">
  <li><a href="{{ route('students.list') }}">{{ trans('students::student.students_list') }}</a></li>
  <li><a href="{{ route('student.details.view', $student->id) }}">{{ $student->name }}</a></li>
  <li class="active">{{ trans('students::student.edit_student') }}</li>
</ol>

@endif

@endsection

@section('scripts')

<script type="text/javascript">
C.ready(function(){
    $('#edit-details-form').validate({
        rules:{!! $student_form_validator->renderRules() !!},
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

<form class="form-horizontal" method="POST" id="edit-details-form" action="{{ $student ? route('student.details.edit', $student->id) : route('student.new') }}">

    @if($student)
        <input type="hidden" name="sid" value="{{ $student->id }}">
        <input type="hidden" name="uid" value="{{ $student->user->id }}">
    @endif

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::student.picture') }}</label>
            <div class="col-sm-8">
                {!! Uploader::renderUploader($student ? $student : null, 'picture', 'image_id', 'student_pictures') !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::student.admission_number') }}</label>
            <div class="col-sm-8">
                <input type="text" name="admission_number" class="form-control" value="{{ $student ? $student->admission_number : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::student.admission_date') }}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" name="admitted_on" class="form-control" data-toggle="date-input" value="{{ $student ? formatDate(toUserTz($student->admitted_on)) : '' }}">
                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::student.student_category') }}</label>
            <div class="col-sm-8">
                <select name="student_category_id" class="form-control" data-toggle="select-dropdown">
                    @foreach($student_categories as $student_category)
                        <option></option>
                        @if($student && $student_category->id == $student->student_category_id)
                            <option selected value="{{ $student_category->id }}">{{ $student_category->name }}</option>
                        @else
                            <option value="{{ $student_category->id }}">{{ $student_category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>                        
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::student.first_name') }}</label>
            <div class="col-sm-8">
                <input type="text" name="first_name" class="form-control" placeholder="Jon" value="{{ $student ? $student->first_name : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::student.last_name') }}</label>
            <div class="col-sm-8">
                <input type="text" name="last_name" class="form-control" placeholder="Doe" value="{{ $student ? $student->last_name : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('students::student.date_of_birth') }}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" name="date_of_birth" class="form-control" data-toggle="date-input" value="{{ $student ? $student->date_of_birth : '' }}">
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