@extends('dashboard::layouts.tab_view')

@section('title', $batch ? trans('classes::batch.edit_batch') : trans('classes::batch.new_batch'))

@section('styles')
    @parent
    <link href="{{ mix('/assets/classes/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/classes/js/editBatchDetails.js') }}"></script>
@endsection

@section('breadcrumbs')

    @if($batch)

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a
                        href="{{ route('batches.list') }}">{{ trans('classes::batch.batches') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('batch.details.view', $batch->id) }}">{{ $batch->name }}</a>
            </li>
            <li class="breadcrumb-item active">{{ trans('classes::batch.edit_batch') }}</li>
        </ol>

    @endif

@endsection

@section('tabs')

    @include('classes::partials.edit_batch_tabs')

@endsection

@section('tab')

    <div id="editBatchDetails">
        <edit-batch-details
                @if($batch)
                :entity="{{$batch}}"
                @endif
                :validation="{{$batch_form_validator->renderRules()}}">

        </edit-batch-details>
    </div>

@endsection