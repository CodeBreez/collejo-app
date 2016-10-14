@extends('collejo::dash.sections.tab_view')

@section('title', $student->name)

@section('tools')

@can('edit_user_account_info')
	<a href="{{ route('student.account.edit', $student->id) }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>  
@endcan

@endsection

@section('tabs')

    @include('students::partials.view_student_tabs')

@endsection

@section('tab')

<div class="col-sm-6">
	<dl class="row">
		<dt class="col-sm-4">{{ trans('students::student.email') }}</dt>
		<dd class="col-sm-8">{{ $student->user->email }}</dd>
	</dl>	
</div>

@endsection