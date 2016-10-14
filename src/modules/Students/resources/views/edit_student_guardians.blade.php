@extends('collejo::dash.sections.tab_view')

@section('title', $student->name)

@section('tools')

@can('assign_guardian_to_student')
    <a href="{{ route('student.assign_guardian', $student->id) }}" data-toggle="ajax-modal" class="btn btn-primary pull-right"><i class="fa fa-fw fa-plus"></i> {{ trans('students::student.assign_guardian') }}</a>  
@endcan

@endsection

@section('tabs')

    @include('students::partials.edit_student_tabs')

@endsection

@section('tab')

<table class="table" id="guardians">

    <tr>
        <th width="30%">{{ trans('students::guardian.name') }}</th>
        <th width="*">{{ trans('students::guardian.students') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($student->guardians as $guardian)

        @include('students::partials.guardian')

    @endforeach

</table>



@endsection