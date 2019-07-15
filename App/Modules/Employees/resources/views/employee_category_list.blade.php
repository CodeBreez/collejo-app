@extends('dashboard::layouts.table_view')

@section('title', trans('employees::employee_category.employee_categories'))

@section('total', $employee_categories->total())

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/employees/js/employeeCategoriesList.js') }}"></script>
@endsection

@section('tools')

    @can('add_edit_employee_category')

        <a href="{{ route('employee_category.new') }}" class="btn btn-primary">
            <i class="fa fa-fw fa-plus"></i> {{ trans('employees::employee_category.new_employee_category') }}
        </a>

    @endcan

@endsection

@section('table')

    <div id="employeeCategoriesList">
        <employee-categories-list
                @if($employee_categories->count())
                :employee-categories="{{$employee_categories->toJson()}}"
                @endif
        ></employee-categories-list>
    </div>

@endsection