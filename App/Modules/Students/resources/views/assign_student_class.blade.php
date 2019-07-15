@extends('dashboard::layouts.tab_view')

@section('title', trans('students::student.assign_class'))

@section('scripts')
	@parent
	<script type="text/javascript" src="{{ mix('/assets/students/js/assignStudentClass.js') }}"></script>
@endsection

@section('breadcrumbs')

	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="{{ route('students.list') }}">{{ trans('students::student.students') }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route('student.classes.view', $student->id) }}">{{ $student->name }}</a>
		</li>
		<li class="breadcrumb-item active">{{ trans('students::student.assign_class') }}</li>
	</ol>

@endsection

@section('tools')

@endsection

@section('tabs')

    @include('students::partials.edit_student_tabs')

@endsection

@section('tab')

	<div id="assignStudentClass">
		<assign-student-class
				:entity="{{collect($student)}}"
				:classes="{{collect($classes)}}"
				:validation="{{$student_class_form_validator->renderRules()}}">

		</assign-student-class>
	</div>

@endsection