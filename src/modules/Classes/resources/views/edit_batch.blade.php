@extends('collejo::dash.sections.tab_view')

@section('title', $batch ? trans('classes::batch.edit_batch') : trans('classes::batch.new_batch'))

@section('scripts')

<script type="text/javascript">
$(function(){

    $('#edit-batch').validate({
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

    @include('classes::partials.batch_tabs')

@endsection

@section('tab')

<form method="POST" id="edit-batch" class="form-horizontal" action="{{ $batch ? route('batch.details.edit', $batch->id) : route('batch.new') }}">

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('classes::batch.name') }}</label>
            <div class="col-sm-8">
                <input type="text" name="name" class="form-control" placeholder="Batch - {{ date('Y', time()) }}" value="{{ $batch ? $batch->name : '' }}">
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