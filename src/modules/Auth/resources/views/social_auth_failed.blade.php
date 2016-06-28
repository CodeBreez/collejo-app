@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="col-md-4 col-md-offset-4">
	<div class="form-auth">
	    <h2 class="text-center">Oh no..</h2>
	    <p>Something went wrong while trying to login with your social network account.</p>

	    <p>This might've caused  by one of the following reasons:</p>

	    <ul>
	    	<li>Your login session with the social network expired</li>
	    	<li>You denied access to your social account</li>
	    	<li>You have followed an invalid url</li>
	    	<li>The third party server did not respond</li>
	    </ul> 

	    <p>If the problem persists, try loggin in with your email.  </p>

	    <a href="/auth/login" class="btn btn-default btn-lg btn-block">Go Back</a>
    </div>
</div>

@endsection