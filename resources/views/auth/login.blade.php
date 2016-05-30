@extends('collejo::layouts.auth')

@section('title', 'Login')

@section('content')

<script type="text/javascript">
$(function(){
    $('#login-form').validate({
        rules:{
            email:{
                required:true,
                email:true
            },
            password:{
                required:true
            }
        },
        submitHandler: function(form){
            $(form).ajaxSubmit({
                dataType:  'json',
                beforeSubmit:collejo.lockform(form),
                success: function(response){
                    if(!response.success){
                        collejo.unlockform(form)
                    }                   
                }
            });
        }
    });

});    
</script>

<div class="form-auth">

	<form method="POST" action="{{ route('auth.login') }}" id="login-form">

		<div class="text-center">
			<img src="/images/logo.png">
		</div>

		<label for="inputEmail" class="sr-only">Email</label>
		<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" autofocus>

		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">

		<div class="checkbox">
		    <label><input type="checkbox" name="remember"> Remember me</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit"><span class="ladda-label">Login</span></button>

	</form>

</div>

@endsection