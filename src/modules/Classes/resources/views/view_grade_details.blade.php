@extends('collejo::dash.sections.tab_view')

@section('title', $grade->name)

@section('tools')

<a href="{{ route('grade.details.edit', $grade->id) }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>  

@endsection

@section('tabs')

    @include('classes::partials.view_grade_tabs')

@endsection

@section('tab')

<div class="col-sm-6">
    <dl class="row">
        <dt class="col-sm-4">{{ trans('classes::grade.name') }}</dt>
        <dd class="col-sm-8">{{ $grade->name }}</dd>
    </dl>   
</div>

<div class="clearfix"></div>


@endsection