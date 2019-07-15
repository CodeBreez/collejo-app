@extends('auth::layouts.auth')

@section('title', trans('auth::auth.reauth'))

@section('styles')
    @parent
    <link href="{{ mix('/assets/auth/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/auth/js/reauth.js') }}"></script>
@endsection

@section('content')

    <div id="reauth">
        <reauth :validation="{{$reauth_form_validator->renderRules()}}"></reauth>
    </div>

@endsection