@extends('collejo::dash.sections.tab_view')

@section('title', $student ? 'Edit Student': 'New Student')

@section('breadcrumbs')

@if($student)

<ol class="breadcrumb">
  <li><a href="{{ route('students.list') }}">Students List</a></li>
  <li><a href="{{ route('student.details.view', $student->id) }}">{{ $student->name }}</a></li>
  <li class="active">Edit Student</li>
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

    @include('students::partials.edit_tabs')

@endsection

@section('tab')

<form class="form-horizontal" method="POST" id="edit-details-form" action="{{ $student ? route('student.details.edit', $student->id) : route('student.new') }}">

    @if($student)
        <input type="hidden" name="sid" value="{{ $student->id }}">
        <input type="hidden" name="uid" value="{{ $student->user->id }}">
    @endif

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">Admission Number</label>
            <div class="col-sm-8">
                <input type="text" name="admission_number" class="form-control" value="{{ $student ? $student->admission_number : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Admission Date</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" name="admitted_on" class="form-control" data-toggle="date-input" value="{{ $student ? formatDate(toUserTz($student->admitted_on)) : '' }}">
                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                </div>
            </div>
        </div>                        
        <div class="form-group">
            <label class="col-sm-4 control-label">First Name</label>
            <div class="col-sm-8">
                <input type="text" name="first_name" class="form-control" placeholder="Jon" value="{{ $student ? $student->first_name : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Last Name</label>
            <div class="col-sm-8">
                <input type="text" name="last_name" class="form-control" placeholder="Doe" value="{{ $student ? $student->last_name : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Date of Birth</label>
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
                <button type="submit" class="btn btn-primary btn-lg" data-loading-text="Saving...">Save</button>
            </div>
        </div>
    </div>
    
    <div class="clearfix"></div>

</form>

@endsection