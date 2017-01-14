@extends('collejo::dash.sections.table_view')

@section('title', trans('subjects::subject.subjects'))

@section('count', $subjects->total())

@section('tools')

@can('create_subject')
    <a href="{{ route('subject.new') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('common.create_new') }}</a>
@endcan

@endsection

@section('table')

@if($subjects->count())

<table class="table" id="subjects">
                
    <tr>
        <th width="*">{{ trans('subjects::subject.name') }}</th>
        <th width="20%">{{ trans('subjects::subject.admission_date') }}</th>
        <th width="15%">{{ trans('subjects::subject.batch') }}</th>
        <th width="10%">{{ trans('subjects::subject.grade') }}</th>
        <th width="10%">{{ trans('subjects::subject.class') }}</th>
        <th width="20%">{{ trans('subjects::subject.guardians') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($subjects as $subject)

        @include('subjects::partials.subject')

    @endforeach

</table>

<div class="pagination-row">{{ $subjects->appends(Request::except('page'))->render() }}</div>

@else

<div class="placeholder-row">
    <div class="placeholder">{{ trans('subjects::subject.empty_list') }}</div>
</div>

@endif

@endsection

