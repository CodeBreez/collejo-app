@extends('dashboard::layouts.tab_view')

@section('title', $student->name)

@section('tools')

	@can('assign_student_to_class')
		<a href="{{ route('student.classes.edit', $student->id) }}" class="btn btn-primary">
			<i class="fa fa-fw fa-edit"></i> {{ trans('base::common.edit') }}
		</a>
	@endcan

@endsection

@section('tabs')

    @include('students::partials.view_student_tabs')

@endsection

@section('tab')

<div class="col-sm-12">

	@foreach($student->classes as $class)

		<dl class="row">
			<dd class="col-sm-3">

				@can('view_batch_details')
					<a href="{{ route('batch.details.view', $class->pivot->batch_id) }}">
						{{ $classRepository->findBatch($class->pivot->batch_id)->name }}
					</a>
				@endcan

				@cannot('view_batch_details')
					{{ $classRepository->findBatch($class->pivot->batch_id)->name }}
				@endcannot
			</dd>
			<dd class="col-sm-3">{{ $class->grade->name }}</dd>
			<dd class="col-sm-3">{{ $class->name }}</dd>
			<dd class="col-sm-3">{{ formatDate(toUserTz($class->pivot->created_at)) }}</dd>
		</dl>

	@endforeach

</div>

@endsection