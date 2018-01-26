@extends('auth::layouts.auth')

@section('title', trans('auth::login'))

@section('styles')
    <link href="{{ mix('/assets/auth/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('/assets/auth/js/login.js') }}"></script>
@endsection

@section('content')

<div id="login">
    <login></login>
</div>

@endsection