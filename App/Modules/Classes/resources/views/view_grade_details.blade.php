@extends('dashboard::layouts.tab_view')

@section('title', $grade->name)

@section('tools')

    @can('add_edit_batch')
        <a href="{{ route('grade.details.edit', $grade->id) }}" class="btn btn-primary"><i
                    class="fa fa-fw fa-edit"></i> {{ trans('base::common.edit') }}</a>
    @endcan

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