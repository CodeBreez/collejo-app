@extends('dashboard::layouts.dash')

@section('title', trans('classes::batch.batches_list'))

@section('styles')
    @parent
    <link href="{{ mix('/assets/classes/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/classes/js/batches.js') }}"></script>
@endsection

@section('content')

    <div id="batchList">
        <batch-list></batch-list>
    </div>

@endsection