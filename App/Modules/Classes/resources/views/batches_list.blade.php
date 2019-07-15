@extends('dashboard::layouts.table_view')

@section('title', trans('classes::batch.batches'))

@section('count', $batches->count())

@section('styles')
    @parent
    <link href="{{ mix('/assets/classes/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/classes/js/batchesList.js') }}"></script>
@endsection

@section('tools')

    @can('add_edit_batch')

        <a href="{{ route('batch.new') }}" class="btn btn-primary"><i
                    class="fa fa-fw fa-plus"></i> {{ trans('classes::batch.new_batch') }}</a>

    @endcan

@endsection

@section('table')

    <div id="batchesList">
        <batches-list
                @if($batches->count())
                :batches="{{$batches->toJson()}}"
                @endif
        ></batches-list>
    </div>

@endsection