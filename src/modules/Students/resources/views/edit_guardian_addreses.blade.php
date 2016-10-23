@extends('collejo::dash.sections.tab_view')

@section('title', $guardian->name)

@section('breadcrumbs')

<ol class="breadcrumb">
  <li><a href="{{ route('guardians.list') }}">{{ trans('students::guardian.guardians_list') }}</a></li>
  <li><a href="{{ route('guardian.addresses.view', $guardian->id) }}">{{ $guardian->name }}</a></li>
  <li class="active">{{ trans('students::guardian.edit_guardian') }}</li>
</ol>

@endsection

@section('tools')

<a href="{{ route('guardian.address.new', $guardian->id) }}" data-modal-backdrop="static" data-modal-keyboard="false" class="btn btn-primary pull-right" data-toggle="ajax-modal"><i class="fa fa-plus"></i> {{ trans('students::address.new_address') }}</a>  

@endsection

@section('tabs')

    @include('students::partials.edit_guardian_tabs')

@endsection

@section('tab')


<div id="addresses" class="column-list">

    <div class="columns">

        @foreach($guardian->addresses as $address)

            @include('students::partials.guardian_address')

        @endforeach

    </div>

    <div class="col-md-6">
        <div class="placeholder">{{ trans('students::address.empty_list') }}</div>
    </div>


</div>  

<div class="clearfix"></div>


@endsection