@extends('dashboard::layouts.tab_view')

@section('title', $guardian ? trans('students::guardian.edit_guardian') : trans('students::guardian.new_guardian'))

@section('scripts')
	@parent
	<script type="text/javascript" src="{{ mix('/assets/students/js/editGuardianDetails.js') }}"></script>
@endsection

@section('breadcrumbs')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('guardians.list') }}">{{ trans('students::guardian.guardians_list') }}</a>
        </li>
        @if($guardian)
            <li class="breadcrumb-item">
                <a href="{{ route('guardian.details.view', $guardian->id) }}">{{ $guardian->name }}</a>
            </li>
        @endif
        <li class="breadcrumb-item active">{{  $guardian ? trans('students::guardian.edit_guardian') : trans('students::guardian.new_guardian') }}</li>
    </ol>

@endsection

@section('tabs')

	@include('students::partials.edit_guardian_tabs')

@endsection

@section('tab')

	<div id="editGuardianDetails">
		<edit-guardian-details
				@if($guardian)
				:entity="{{collect($guardian)}}"
				@endif
				:validation="{{$guardian_details_form_validator->renderRules()}}">

		</edit-guardian-details>
	</div>

@endsection