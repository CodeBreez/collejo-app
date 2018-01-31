@extends('dashboard::layouts.tab_view')

@section('title', $batch ? trans('classes::batch.edit_batch') : trans('classes::batch.new_batch'))

@section('styles')
    @parent
    <link href="{{ mix('/assets/classes/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/classes/js/editBatchTerms.js') }}"></script>
@endsection

@section('breadcrumbs')

    @if($batch)

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a
                        href="{{ route('batches.list') }}">{{ trans('classes::batch.batches_list') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('batch.details.view', $batch->id) }}">{{ $batch->name }}</a>
            </li>
            <li class="breadcrumb-item active">{{ trans('classes::batch.edit_batch') }}</li>
        </ol>

    @endif

@endsection

@section('tools')

    <a href="{{ route('batch.term.new', $batch->id) }}" data-modal-backdrop="static" data-modal-keyboard="false"
       class="btn btn-primary pull-right" data-toggle="ajax-modal"><i
                class="fa fa-plus"></i> {{ trans('classes::term.new_term') }}</a>

@endsection

@section('tabs')

    @include('classes::partials.edit_batch_tabs')

@endsection

@section('tab')

    <div id="editBatchDetails">
        <edit-batch-terms :batch="{{$batch}}"></edit-batch-terms>
    </div>

@endsection