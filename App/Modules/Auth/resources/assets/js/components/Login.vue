<template>
    <div class="form-auth">

        <b-form @submit.prevent="onSubmit" novalidate>

            <div class="text-center">
                <div class="auth-logo"></div>
            </div>

            <h2 class="text-center brand-text">{{trans('auth::auth.app_name')}}</h2>

            <c-form-input type="email"
                              v-model="form.email"
                              name="email"
                              :label="trans('auth::auth.email')"
                              :validator="$v"></c-form-input>

            <c-form-input type="password"
                              v-model="form.password"
                              name="password"
                              :label="trans('auth::auth.password')"
                              :validator="$v"></c-form-input>

            <div class="checkbox-row">
                <b-form-checkbox v-model="form.remember_me">
                    {{ trans('auth::auth.remember_me') }}
                </b-form-checkbox>
            </div>

            <b-button type="submit" :disabled="submitDisabled" variant="primary" block>{{ trans('auth::auth.login') }}</b-button>
        </b-form>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.FormHelpers],
        props:{
            validation: Object
        },
        data(){
	    	return {
                action: this.route('login'),
                form: {
                    email: null,
                    password: null,
                    remember_me: false
			    }
		    }
        }
    }
</script>