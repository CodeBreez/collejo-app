@extends('collejo::dash.sections.tab_view')

@section('title', $student ? 'Edit Student': 'New Student')

@section('scripts')

<script type="text/javascript">
$(function(){
    $('#edit-contacts-form').validate({
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

@section('tools')

<a href="{{ route('students.edit.contacts.new', $student->id) }}" class="btn btn-primary pull-right" data-toggle="ajax-modal"><i class="fa fa-plus"></i> New Contact</a>  

@endsection

@section('tabs')

    @include('students::partials.tabs')

@endsection

@section('tab')

<form class="form-horizontal" method="POST" id="edit-contacts-form" action="{{ route('students.edit.contacts', $student->id) }}">

    <input type="hidden" name="sid" value="{{ $student->id }}">
    <input type="hidden" name="uid" value="{{ $student->user->id }}">

    <div class="col-xs-6">

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-3"><label>Address</label></div>
                    <div class="col-xs-9">asdh, 12312 klsdlas</div>
                </div>
            </div>
            <div class="panel-footer">
                <span class="label label-danger">Emergency</span>
                <div class="tools-footer">
                    <a class="btn btn-xs btn-default pull-left"><i class="fa fa-edit"></i> Edit</a>
                    <a class="btn btn-xs btn-danger pull-left"><i class="fa fa-trash"></i> Delete</a>
                </div>
            </div>
        </div>

    </div>  

    <div class="clearfix"></div>

</form>

@endsection