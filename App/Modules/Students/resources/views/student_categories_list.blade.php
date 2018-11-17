@extends('dashboard::layouts.table_view')

@section('title', trans('students::student_category.student_categories'))

@section('count', $student_categories->total())

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/students/js/studentCategoriesList.js') }}"></script>
@endsection

@section('tools')

    @can('add_edit_student_category')

        <a href="{{ route('student_category.new') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> {{ trans('students::student_category.new_student_category') }}
        </a>

    @endcan

@endsection

@section('table')

    <div id="studentCategoriesList">
        <student-categories-list
                @if($student_categories->count())
                :categories="{{$student_categories->toJson()}}"
                @endif
        ></student-categories-list>
    </div>

@endsection
