@extends('collejo::dash.sections.tab_view')

@section('title', $batch->name)

@section('tools')

	@can('add_edit_batch')
		<a href="{{ route('batch.terms.edit', $batch->id) }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>  
	@endcan
	
@endsection

@section('tabs')

    @include('classes::partials.view_batch_tabs')

@endsection

@section('tab')

@foreach($batch->terms as $terms)
	<span class="label label-default">{{ $terms->name }}</span>
@endforeach

<div class="clearfix"></div>


@endsection