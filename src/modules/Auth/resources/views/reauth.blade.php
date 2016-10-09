@extends('collejo::layouts.auth')

@section('title', trans('auth::auth.reauth'))

@section('content')

<script type="text/javascript">
$(function(){
    $('#reauth-form').validate({
        rules:{
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

	<form method="POST" action="{{ route('auth.reauth') }}" id="reauth-form">

        <div class="text-center">
            <img src="{{ asset(elixir('/images/collejo_mid.png')) }}">
        </div>

        <h2 class="text-center brand-text">Collejo</h2>

        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i> {{ trans('auth::auth.reauth_msg') }}
        </div>

        <div class="form-group">
            <label>{{ trans('auth::auth.password') }}</label>
            <input type="password" name="password" class="form-control">
        </div>

		<button class="btn btn-lg btn-primary btn-block" type="submit"><span class="ladda-label">{{ trans('common.continue') }}</span></button>

	</form>

</div>

@endsection