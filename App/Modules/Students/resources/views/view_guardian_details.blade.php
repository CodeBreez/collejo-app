@extends('dashboard::layouts.tab_view')

@section('title', $guardian->name)

@section('tools')

	@can('edit_student_general_details')
		<a href="{{ route('guardian.details.edit', $guardian->id) }}" class="btn btn-primary">
			<i class="fa fa-fw fa-edit"></i> {{ trans('base::common.edit') }}
		</a>
	@endcan

@endsection

@section('tabs')

    @include('students::partials.view_guardian_tabs')

@endsection

@section('tab')


<div class="col-sm-6">
	<dl class="row">
		<dt class="col-sm-4">{{ trans('students::guardian.ssn') }}</dt>
		<dd class="col-sm-8">{{ $guardian->ssn }}</dd>
	</dl>
	<dl class="row">
		<dt class="col-sm-4">{{ trans('students::guardian.name') }}</dt>
		<dd class="col-sm-8">{{ $guardian->name }}</dd>
	</dl>
</div>


@endsection