@extends('collejo::dash.sections.tab_view')

@section('title', $batch ? 'Edit Class': 'New Class')

@section('scripts')

<script type="text/javascript">
$(function(){

    $('#edit-class').validate({
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

    @include('classes::partials.class_tabs')

@endsection

@section('tab')

<form method="POST" id="edit-class" class="form-horizontal" action="{{ $class ? route('classes.class.edit.detail', ['class' => $class->id]) : route('classes.class.new') }}">

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">Name</label>
            <div class="col-sm-8">
                <input type="text" name="name" class="form-control" placeholder="Grade x Class x" value="{{ $class ? $class->name : '' }}">
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