@extends('collejo::dash.sections.tab_view')

@section('title', 'Edit Grade')

@section('tools')

<a href="{{ route('grade.class.new', $grade->id) }}" data-modal-backdrop="static" data-modal-keyboard="false" class="btn btn-primary pull-right" data-toggle="ajax-modal"><i class="fa fa-plus"></i> New Class</a>  

@endsection

@section('tabs')

    @include('classes::partials.grade_tabs')

@endsection

@section('tab')


<div id="classes" class="table-list">

    <table class="table">

        <tr>
            <th>Name</th>
            <th class="text-right"></th>
        </tr>

        @foreach($grade->classes as $class)

            @include('classes::partials.class')

        @endforeach

    </table>


    <div class="placeholder">This grade does not have any classes defined.</div>

</div>  

<div class="clearfix"></div>


@endsection