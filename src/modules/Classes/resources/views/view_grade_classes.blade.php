@extends('collejo::dash.sections.tab_view')

@section('title', $grade->name)

@section('tools')

<a href="{{ route('grade.classes.edit', $grade->id) }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>  

@endsection

@section('tabs')

    @include('classes::partials.view_grade_tabs')

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