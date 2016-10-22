@extends('collejo::dash.sections.table_view')

@section('title', trans('students::guardian.guardians'))

@section('count', $guardians->total())

@section('table')

@if($guardians->count())

<table class="table" id="guardians">
                
    <tr>
        <th width="30%">{{ trans('students::guardian.name') }}</th>
        <th width="*">{{ trans('students::guardian.students') }}</th>
        <th width="10%"></th>
    </tr>

    @foreach($guardians as $guardian)

        @include('students::partials.guardian')

    @endforeach

</table>

<div class="pagination-row">{{ $guardians->render() }}</div>

@else

<div class="placeholder-row">
    <div class="placeholder">{{ trans('students::guardian.empty_list') }}</div>
</div>

@endif

@endsection

