@extends('dashboard::layouts.table_view')

@section('title', trans('students::student.students'))

@section('total', $students->total())

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/students/js/studentsList.js') }}"></script>
@endsection

@section('tools')

    @can('add_edit_student')

        <a href="{{ route('student.new') }}" class="btn btn-primary">
            <i class="fa fa-fw fa-plus"></i> {{ trans('students::student.new_student') }}
        </a>

    @endcan

@endsection

@section('table')

    <div id="studentsList">
        <students-list
                @if($students->count())
                :students="{{$students->toJson()}}"
                @endif
        ></students-list>
    </div>

@endsection