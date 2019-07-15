@extends('dashboard::layouts.tab_view')

@section('title', $employee_category ? trans('employees::employee_category.edit_employee_category') : trans('employees::employee_category.new_employee_category'))

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/employees/js/editEmployeeCategoryDetails.js') }}"></script>
@endsection

@section('breadcrumbs')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('employee_categories.list') }}">{{ trans('employees::employee_category.employee_categories') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ $employee_category ? trans('employees::employee_category.edit_employee_category') : trans('employees::employee_category.new_employee_category') }}</li>
    </ol>

@endsection

@section('tabs')

    @include('employees::partials.edit_employee_category_tabs')

@endsection

@section('tab')

    <div id="editEmployeeCategoryDetails">
        <edit-employee-category-details
                @if($employee_category)
                :entity="{{collect($employee_category)}}"
                @endif
                :validation="{{$category_form_validator->renderRules()}}">

        </edit-employee-category-details>
    </div>

@endsection