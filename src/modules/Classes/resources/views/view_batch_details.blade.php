@extends('collejo::dash.sections.tab_view')

@section('title', $batch->name)

@section('tools')

<a href="{{ route('batch.details.edit', $batch->id) }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>  

@endsection

@section('tabs')

    @include('classes::partials.view_batch_tabs')

@endsection

@section('tab')

<div class="col-sm-6">
    <dl class="row">
        <dt class="col-sm-4">{{ trans('classes::batch.name') }}</dt>
        <dd class="col-sm-8">{{ $batch->name }}</dd>
    </dl>   
</div>

<div class="clearfix"></div>


@endsection