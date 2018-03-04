<template>
    <div class="form-auth">

        <b-form @submit.prevent="onSubmit">

            <div class="text-center">
                <div class="auth-logo"></div>
            </div>

            <h2 class="text-center brand-text">{{trans('auth::auth.app_name')}}</h2>

            <b-form-group :label="trans('auth::auth.email')" label-for="emailInput">
                <b-form-input id="emailInput" type="email"
                              v-model="loginForm.email"
                              @input="$v.loginForm.email.$touch()"></b-form-input>
                <div class="invalid-feedback" v-if="!$v.loginForm.email.required">{{trans('base::validation.required', trans('auth::auth.email'))}}</div>
                <div class="invalid-feedback" v-if="!$v.loginForm.email.email">{{trans('base::validation.email')}}</div>
            </b-form-group>

            <b-form-group :label="trans('auth::auth.password')" label-for="passwordInput">
                <b-form-input id="passwordInput" type="password"
                              v-model="loginForm.password"
                              @input="$v.loginForm.password.$touch()"></b-form-input>
                <div class="invalid-feedback" v-if="!$v.loginForm.password.required">{{trans('base::validation.required', trans('auth::auth.email'))}}</div>
            </b-form-group>

            <div class="checkbox-row">
                <b-form-checkbox v-model="loginForm.remember_me">
                    {{ trans('auth::auth.remember_me') }}
                </b-form-checkbox>
            </div>

            <b-button type="submit" :disabled="submitDisabled" variant="primary" block>{{ trans('auth::auth.login') }}</b-button>
        </b-form>
    </div>
</template>

<script>

    import { required, email } from 'vuelidate/lib/validators'

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.FormHelpers],
        data(){
	    	return {
                loginForm: {
                    email: '',
                    password: '',
                    remember_me: false
			    },
                submitDisabled: false
		    }
        },
        validations: {
            loginForm:{
                email: {
                    required,
                    email
                },
                password: {
                    required
                }
            }
        },
        methods:{
	        onSubmit(){

	            if(!this.$v.loginForm.$error){
                    this.submitDisabled = true;

                    axios.post(this.route('login'), this.loginForm)
                        .then(this.handleSubmitResponse)
                        .catch(this.handleSubmitResponse);
                }
            }
        }
    }
</script>