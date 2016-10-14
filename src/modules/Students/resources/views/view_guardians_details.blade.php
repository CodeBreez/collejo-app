@extends('collejo::dash.sections.tab_view')

@section('title', $student->name)

@section('tools')

@can('edit_student_general_details')
    <a href="{{ route('student.guardians.edit', $student->id) }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>  
@endcan

@endsection

@section('tabs')

    @include('students::partials.view_student_tabs')

@endsection

@section('tab')

<table class="table">
    <tr>
        <th>{{ trans('students::guardian.name') }}</th>
    </tr>

    @foreach($student->guardians as $guardian)

        <tr>
            <td>
                {{ $guardian->name }}
            </td>
        </tr>

    @endforeach

</table>

@endsection