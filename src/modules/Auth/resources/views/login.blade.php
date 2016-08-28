@extends('collejo::layouts.auth')

@section('title', trans('auth::auth.login'))

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
                beforeSubmit:Collejo.form.lock(form),
                success: function(response){
                    if(!response.success){
                        Collejo.form.unlock(form)
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
			<img src="{{ asset(elixir('/images/collejo_mid.png')) }}">
		</div>

        <h2 class="text-center brand-text">Collejo</h2>

        <div class="form-group">
            <label>{{ trans('auth::auth.email') }}</label>
            <input type="email" name="email" class="form-control" placeholder="name@example.com" autofocus>
        </div>

        <div class="form-group">
            <label>{{ trans('auth::auth.password') }}</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="checkbox-row">
            <input type="checkbox" name="remember" id="remember-me">
            <label for="remember-me"> <span>{{ trans('auth::auth.remember_me') }}</span></label> 
        </div>

		<button class="btn btn-lg btn-primary btn-block" type="submit"><span class="ladda-label">{{ trans('auth::auth.login') }}</span></button>

	</form>

</div>

@endsection