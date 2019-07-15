@extends('dashboard::layouts.tab_view')

@section('title', trans('employees::employee.edit_employee'))

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/acl/js/editUserAccount.js') }}"></script>
@endsection

@section('breadcrumbs')

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
          <a href="{{ route('employees.list') }}">{{ trans('employees::employee.employees') }}</a>
      </li>
      <li class="breadcrumb-item">
          <a href="{{ route('employee.account.view', $employee->id) }}">{{ $employee->name }}</a>
      </li>
      <li class="breadcrumb-item active">{{ trans('employees::employee.edit_employee') }}</li>
    </ol>

@endsection

@section('tabs')

    @include('employees::partials.edit_employee_tabs')

@endsection

@section('tab')

    <div id="editUserAccount">
        <edit-user-account
                @if($user)
                :entity="{{collect($user)}}"
                @endif
                :validation="{{$user_form_validator->renderRules()}}">

        </edit-user-account>
    </div>

@endsection