@extends('collejo::dash.sections.tab_view')

@section('title', $guardian->name)

@section('tools')

<a href="{{ route('guardian.addresses.edit', $guardian->id) }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>  

@endsection

@section('tabs')

    @include('students::partials.view_guardian_tabs')

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