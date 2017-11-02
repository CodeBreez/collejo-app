<template>
    <div class="form-auth">

        <vf-form :action="route('home')" method="POST">

            <div class="text-center">
                <div class="auth-logo"></div>
            </div>

            <h2 class="text-center brand-text">Collejo</h2>

            <vf-text :label="trans('auth::auth.email')" required name="email" ref="email"></vf-text>

            <vf-password :label="trans('auth::auth.password')" required name="password" ref="password"></vf-password>

            <div class="checkbox-row">
                <input type="checkbox" name="remember" id="remember-me">
                <label for="remember-me"> <span>{{ trans('auth::auth.remember_me') }}</span></label>
            </div>

            <vf-submit class="btn-block">{{ trans('auth::auth.login') }}</vf-submit>

        </vf-form>

    </div>
</template>

<script>

    export default {
	    mixins: [ C.mixins.Routes, C.mixins.Trans ],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>