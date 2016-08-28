@extends('collejo::dash.sections.tab_view')

@section('title', trans('classes::batch.edit_batch'))

@section('breadcrumbs')

<ol class="breadcrumb">
  <li><a href="{{ route('batches.list') }}">{{ trans('classes::batch.batches_list') }}</a></li>
  <li><a href="{{ route('batch.details.view', $batch->id) }}">{{ $batch->name }}</a></li>
  <li class="active">{{ trans('classes::batch.edit_batch') }}</li>
</ol>

@endsection

@section('scripts')

<script type="text/javascript">
$(function(){

    $('#batch-grades').validate({
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

    @include('classes::partials.edit_batch_tabs')

@endsection

@section('tab')

<form method="POST" id="batch-grades" class="form-horizontal" action="{{ route('batch.grades.edit', $batch->id) }}">

    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-sm-4 control-label">{{ trans('classes::batch.grades') }}</label>
            <div class="col-sm-8">
                
                @foreach($grades as $grade)

                    <div class="checkbox-row">

                        @if($batch->grades->contains($grade->id))
                            <input type="checkbox" name="grades[]" value="{{ $grade->id }}" id="chk-{{ $grade->id }}" checked>
                        @else
                            <input type="checkbox" name="grades[]" value="{{ $grade->id }}" id="chk-{{ $grade->id }}">
                        @endif

                        <label for="chk-{{ $grade->id }}">  <span>{{ $grade->name }}</span></label>
                    </div> 

                @endforeach

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