@extends('dashboard::layouts.tab_view')

@section('title', trans('classes::batch.edit_batch'))

@section('styles')
    @parent
    <link href="{{ mix('/assets/classes/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/classes/js/editBatchGrades.js') }}"></script>
@endsection

@section('breadcrumbs')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('batches.list') }}">{{ trans('classes::batch.batches') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('batch.details.view', $batch->id) }}">{{ $batch->name }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('classes::batch.edit_batch') }}</li>
</ol>

@endsection

@section('tabs')

    @include('classes::partials.edit_batch_tabs')

@endsection

@section('tab')

    <div id="editBatchGrades">
        <edit-batch-grades :grades="{{$grades}}" :batch="{{$batch}}"></edit-batch-grades>
    </div>

@endsection