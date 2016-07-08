@extends('collejo::dash.sections.tab_view')

@section('title', 'Edit Student')

@section('tools')

<a href="{{ route('student.address.new', $student->id) }}" data-modal-backdrop="static" data-modal-keyboard="false" class="btn btn-primary pull-right" data-toggle="ajax-modal"><i class="fa fa-plus"></i> New Contact</a>  

@endsection

@section('tabs')

    @include('students::partials.tabs')

@endsection

@section('tab')


<div id="addresses" class="column-list">

    <div class="columns">

        @foreach($student->addresses as $address)

            @include('students::partials.address')

        @endforeach

    </div>

    <div class="col-md-6">
        <div class="placeholder">This user does not have any contacts defined.</div>
    </div>


</div>  

<div class="clearfix"></div>


@endsection