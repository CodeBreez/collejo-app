@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

<div class="form-auth form-reset-pass">


	<form method="POST" action="/password/reset" id="login_form">

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

		<input type="hidden" name="token" value="{{ $token }}">

		<label for="inputEmail" class="sr-only">Email</label>

		<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
		
		<label for="inputpassword" class="sr-only">Password</label>
		<input type="password" id="inputpassword" name="password" class="form-control" placeholder="Password">

		<label for="inputpassword_confirmation" class="sr-only">Password Confirm</label>
		<input type="password" id="inputpassword_confirmation" name="password_confirmation" class="form-control" placeholder="Password Confirm">

        <div class="text-center">
		<button class="btn btn-lg btn-primary btn-block" type="submit"><span class="ladda-label">Reset Password</span></button>
            <a href="/auth/login" class="pull-left">Back to Login</a>
        </div>

	</form>

</div>

@endsection