@extends('dashboard::layouts.tab_view')

@section('title', $student ? trans('students::student.edit_student') : trans('students::student.new_student'))

@section('styles')
	@parent
	<link href="{{ mix('/assets/media/css/uploader.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
	@parent
	<script type="text/javascript" src="{{ mix('/assets/media/js/uploader.js') }}"></script>
	<script type="text/javascript" src="{{ mix('/assets/students/js/editStudentDetails.js') }}"></script>
@endsection

@section('breadcrumbs')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('students.list') }}">{{ trans('students::student.students_list') }}</a>
        </li>
        @if($student)
            <li class="breadcrumb-item">
                <a href="{{ route('student.details.view', $student->id) }}">{{ $student->name }}</a>
            </li>
        @endif
        <li class="breadcrumb-item active">{{ trans('students::student.edit_student') }}</li>
    </ol>

@endsection

@section('tabs')

	@include('students::partials.edit_student_tabs')

@endsection

@section('tab')

	<div id="editStudentDetails">
		<edit-student-details
				@if($student)
				:entity="{{collect($student)}}"
				@endif
				:student-categories="{{collect($student_categories)}}"
				:validation="{{$student_details_form_validator->renderRules()}}">

		</edit-student-details>
	</div>

@endsection