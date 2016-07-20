@extends('collejo::dash.sections.tab_view')

@section('title', trans('classes::grade.edit_grade'))

@section('tools')

<a href="{{ route('grade.class.new', $grade->id) }}" data-modal-backdrop="static" data-modal-keyboard="false" class="btn btn-primary pull-right" data-toggle="ajax-modal"><i class="fa fa-plus"></i> {{ trans('classes::class.new_class') }}</a>  

@endsection

@section('tabs')

    @include('classes::partials.grade_tabs')

@endsection

@section('tab')


<div id="classes" class="table-list">

    <table class="table">

        <tr>
            <th>{{ trans('classes::class.name') }}</th>
            <th class="text-right"></th>
        </tr>

        @foreach($grade->classes as $class)

            @include('classes::partials.class')

        @endforeach

    </table>


    <div class="placeholder">{{ trans('classes::class.empty_list') }}</div>

</div>  

<div class="clearfix"></div>


@endsection