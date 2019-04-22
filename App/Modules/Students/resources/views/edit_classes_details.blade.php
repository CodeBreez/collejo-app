@extends('dashboard::layouts.tab_view')

@section('title', trans('students::student.edit_student'))

@section('breadcrumbs')

	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="{{ route('students.list') }}">{{ trans('students::student.students') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('student.classes.view', $student->id) }}">{{ $student->name }}</a>
		</li>
		<li class="breadcrumb-item active">{{ trans('students::student.edit_student') }}</li>
	</ol>

@endsection

@section('tools')

@endsection

@section('tabs')

    @include('students::partials.edit_student_tabs')

@endsection

@section('tab')


<div class="col-sm-6">

	@foreach($student->classes as $class)

		<dl class="row">
			<dt class="col-sm-4">{{ $class->name }}</dt>
			<dd class="col-sm-8">{{ formatDate(toUserTz($class->pivot->created_at)) }}</dd>
		</dl>

	@endforeach

</div>

@endsection