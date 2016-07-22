@extends('collejo::dash.sections.tab_view')

@section('title', $batch->name)

@section('tools')

<a href="{{ route('batch.grades.edit', $batch->id) }}" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> {{ trans('common.edit') }}</a>  

@endsection

@section('tabs')

    @include('classes::partials.view_batch_tabs')

@endsection

@section('tab')

@foreach($batch->grades as $grade)
	<span class="label label-default">{{ $grade->name }}</span>
@endforeach

<div class="clearfix"></div>


@endsection