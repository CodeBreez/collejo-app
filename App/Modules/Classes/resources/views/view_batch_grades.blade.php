@extends('dashboard::layouts.tab_view')

@section('title', $batch->name)

@section('tools')

	@can('add_edit_batch')
		<a href="{{ route('batch.grades.edit', $batch->id) }}" class="btn btn-primary">
			<i class="fa fa-fw fa-edit"></i> {{ trans('base::common.edit') }}
		</a>
	@endcan

@endsection

@section('tabs')

    @include('classes::partials.view_batch_tabs')

@endsection

@section('tab')

	<div class="card-group">

		@foreach($batch->grades as $grade)

			<div class="card">
				<div class="card-header">
					<a href="{{ route('grade.details.view', $grade->id) }}">{{ $grade->name }}</a>
				</div>
			</div>

		@endforeach

	</div>

@endsection