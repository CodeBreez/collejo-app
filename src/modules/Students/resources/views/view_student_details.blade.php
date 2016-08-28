@extends('collejo::dash.sections.tab_view')

@section('title', $student->name)

@section('tools')

<a href="{{ route('student.details.edit', $student->id) }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>  

@endsection

@section('tabs')

    @include('students::partials.view_tabs')

@endsection

@section('tab')


<div class="col-sm-6">
	<dl class="row">
		@if($student->picture)
			<img class="img-lazy thumbnail img-responsive" src="{{ $student->picture->url('small') }}">
		@else
			<img class="thumbnail img-responsive" src="{{ asset(elixir('/images/user_avatar_small.png')) }}">
		@endif
	</dl>	
	<dl class="row">
		<dt class="col-sm-4">{{ trans('students::student.admission_number') }}</dt>
		<dd class="col-sm-8">{{ $student->admission_number }}</dd>
	</dl>	
	<dl class="row">
		<dt class="col-sm-4">{{ trans('students::student.admission_date') }}</dt>
		<dd class="col-sm-8">{{ formatDate(toUserTz($student->admitted_on)) }}</dd>
	</dl>	
	<dl class="row">
		<dt class="col-sm-4">{{ trans('students::student.name') }}</dt>
		<dd class="col-sm-8">{{ $student->name }}</dd>
	</dl>
	<dl class="row">
		<dt class="col-sm-4">{{ trans('students::student.date_of_birth') }}</dt>
		<dd class="col-sm-8">{{ $student->date_of_birth }}</dd>
	</dl>
</div>


@endsection