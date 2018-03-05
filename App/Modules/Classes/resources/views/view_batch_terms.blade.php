@extends('dashboard::layouts.tab_view')

@section('title', $batch->name)

@section('tools')

    @can('add_edit_batch')
        <a href="{{ route('batch.terms.edit', $batch->id) }}" class="btn btn-primary">
            <i class="fa fa-fw fa-edit"></i> {{ trans('base::common.edit') }}
        </a>
    @endcan

@endsection

@section('tabs')

    @include('classes::partials.view_batch_tabs')

@endsection

@section('tab')

    <div class="card-group">

        @foreach($batch->terms as $terms)

            <div class="card">
                <div class="card-header">{{ $terms->name }}</div>
                <div class="card-block">
                    <p class="card-text">Start Date : {{ $terms->start_date }}</p>
                    <p class="card-text">End Date : {{ $terms->end_date }}</p>
                </div>
            </div>

        @endforeach

    </div>

@endsection