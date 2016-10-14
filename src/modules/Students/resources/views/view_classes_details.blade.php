@extends('collejo::dash.sections.tab_view')

@section('title', $student->name)

@section('tools')

@can('assign_student_to_class')
	<a href="{{ route('student.classes.edit', $student->id) }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>  
@endcan

@endsection

@section('tabs')

    @include('students::partials.view_student_tabs')

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