@extends('dashboard::layouts.tab_view')

@section('title', $student->name)

@section('scripts')
	@parent
	<script type="text/javascript" src="{{ mix('/assets/students/js/viewStudentClasses.js') }}"></script>
@endsection

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

	<div id="viewStudentClasses">
		<view-student-classes
			:classes="{{collect($classes)}}"
			:entity="{{collect($student)}}
		"></view-student-classes>
	</div>

@endsection