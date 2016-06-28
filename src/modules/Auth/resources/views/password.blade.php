@extends('collejo::layouts.auth')

@section('title', 'Reset Password')

@section('content')

<div class="form-auth form-reset-pass">
    <form method="POST" action="/password/email" id="login_form">

        <div class="text-center">
            <img src="/images/logo.png">
        </div>

        @if($errors->has())
            <div class="alert alert-danger" role="alert">
               @foreach ($errors->all() as $error)
                  <div>{{ $error }}</div>
              @endforeach
            </div>
        @endif

        {!! csrf_field() !!}

        <label for="inputEmail" class="sr-only">Email</label>

        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" autofocus>


        <div class="text-center">
        <button class="btn btn-lg btn-primary btn-block" type="submit"><span class="ladda-label">Reset Password</span></button>
            <a href="/auth/login" class="pull-left">Back to Login</a>
        </div>

    </form>

</div>

@endsection