@extends('collejo::dash.sections.table_view')

@section('title', trans('students::student_category.student_categories'))

@section('tools')

@can('add_edit_student_category')
    <a href="{{ route('student_category.new') }}" class="btn btn-primary pull-right" data-toggle="ajax-modal"><i class="fa fa-plus"></i> {{ trans('common.create_new') }}</a>	
@endcan

@endsection

@section('table')

@if($student_categories->count())

<table class="table" id="student_categories">
                
    <tr>
        <th width="*">{{ trans('students::student_category.name') }}</th>
        <th width="15%">{{ trans('students::student_category.code') }}</th>
        <th width="15%">{{ trans('students::student_category.count') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($student_categories as $student_category)

        @include('students::partials.student_category')

    @endforeach

</table>

<div class="pagination-row">{{ $student_categories->render() }}</div>

@else

<div class="placeholder-row">
    <div class="placeholder">{{ trans('students::student_category.empty_list') }}</div>
</div>

@endif

@endsection

