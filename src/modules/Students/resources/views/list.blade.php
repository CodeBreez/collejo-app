@extends('collejo::dash.sections.table_view')

@section('title', trans('students::student.students'))

@section('tools')

<a href="{{ route('student.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('common.create_new') }}</a>	

@endsection

@section('table')

@if($students->count())

<table class="table" id="students">
                
    <tr>
        <th width="*">{{ trans('students::student.name') }}</th>
        <th width="20%">{{ trans('students::student.admission_date') }}</th>
        <th width="15%">{{ trans('students::student.batch') }}</th>
        <th width="10%">{{ trans('students::student.grade') }}</th>
        <th width="10%">{{ trans('students::student.class') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($students as $student)

        @include('students::partials.student')

    @endforeach

</table>

@else

<div class="placeholder">{{ trans('students::student.empty_list') }}</div>

@endif

@endsection

