@extends('dashboard::layouts.table_view')

@section('title', trans('students::guardian.guardians'))

@section('total', $guardians->total())

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/students/js/guardiansList.js') }}"></script>
@endsection

@section('tools')

    @can('create_guardian')

        <a href="{{ route('guardian.new') }}" class="btn btn-primary">
            <i class="fa fa-fw fa-plus"></i> {{ trans('students::guardian.new_guardian') }}
        </a>

    @endcan

@endsection

@section('table')

    <div id="guardiansList">
        <guardians-list
                @if($guardians->count())
                :guardians="{{$guardians->toJson()}}"
                @endif
        ></guardians-list>
    </div>

@endsection