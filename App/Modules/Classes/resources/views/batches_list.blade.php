@extends('dashboard::layouts.dash')

@section('title', trans('classes::batch.batches_list'))

@section('styles')
    @parent
    <link href="{{ mix('/assets/classes/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/classes/js/batchesList.js') }}"></script>
@endsection

@section('content')

    <div id="batchesList">
        <batches-list></batches-list>
    </div>

@endsection