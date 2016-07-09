@extends('collejo::dash.sections.tab_view')

@section('title', $student->name)

@section('tools')

<a href="{{ route('student.details.edit', $student->id) }}" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Edit</a>  

@endsection

@section('tabs')

    @include('students::partials.view_tabs')

@endsection

@section('tab')


<div class="col-sm-6">
	<dl class="row">
		<dt class="col-sm-4">Admission Number</dt>
		<dd class="col-sm-8">{{ $student->admission_number }}</dd>
	</dl>	
	<dl class="row">
		<dt class="col-sm-4">Admission Date</dt>
		<dd class="col-sm-8">{{ $student->admission_date }}</dd>
	</dl>	
	<dl class="row">
		<dt class="col-sm-4">Name</dt>
		<dd class="col-sm-8">{{ $student->name }}</dd>
	</dl>
	<dl class="row">
		<dt class="col-sm-4">Date of birth</dt>
		<dd class="col-sm-8">{{ $student->date_of_birth }}</dd>
	</dl>
</div>


@endsection