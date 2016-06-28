@extends('layouts.auth')

@section('title', 'Create new account')

@section('content')

<script type="text/javascript">
$(function(){
    $('#auth_continue_form').validate({
        ignore:null,
        rules:{
            email:{
                required:true,
                email:true
            },
            password:{
                required:true
            },
            u_type:{
                required:true
            }
        },
        highlight:function(element){
            if ($(element).parents('.form-group').length ==0) {
                validateHighlight(element);
            }
        },    
        unhighlight:function(element){
            $(element).prev('.error-container').remove();
        },  
        errorPlacement:function(error, element){
            if (element.parents('.form-group').length >0) {
                validatePlaceError(error, element);                
            }
        },
        submitHandler: function(form){
            $(form).ajaxSubmit({
                dataType:  'json',
                beforeSubmit:bw.lockform(form),
                success: function(response){
                    if(!response.success){
                        bw.unlockform(form)
                    }                   
                }
            });
        }
    });

    $('.alert').hide();
});    
</script>

<form method="POST" action="/auth/continue" id="auth_continue_form" class="form-auth">
    {!! csrf_field() !!}

    @if (!is_null($first_name))
        <h3 class="text-center">Hi, {{$first_name}}</h3>        
    @endif

    <h2 class="text-center">Create your account</h2>

    @if (!is_null($avatar))
        <div class="text-center">
            <img class="avatar" src="{{$avatar}}">
        </div>
    @endif

    @if(!is_null($email))

        <input type="hidden" name="email" value="{{$email}}" required>

    @else

        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" value="{{$email}}" required autofocus>

    @endif

    @if(!is_null($email))
        <p class="text-muted text-center">Choose a good password</p>
    @endif

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

    <p class="text-muted text-center">Select account type you wish to create</p>

    <div class="form-group">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default btn1">
                <input type="radio" name="u_type" value="influencer"> I'm an Influencer
            </label>
            <label class="btn btn-default btn2">
                <input type="radio" name="u_type" value="brand"> I'm a Brand
            </label>
        </div>
    </div>

    <button class="btn btn-lg btn-primary btn-block" data-loading-text="Creating Account..." type="submit">Create</button>

</form>



@endsection