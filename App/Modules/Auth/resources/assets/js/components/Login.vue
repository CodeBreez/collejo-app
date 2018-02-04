<template>
    <div class="form-auth">

        <b-form @submit.prevent="onSubmit">

            <div class="text-center">
                <div class="auth-logo"></div>
            </div>

            <h2 class="text-center brand-text">Collejo</h2>

            <b-form-group :label="trans('auth::auth.email')" label-for="emailInput">
                <b-form-input id="emailInput" type="email" v-model="loginForm.email" required></b-form-input>
            </b-form-group>

            <b-form-group :label="trans('auth::auth.password')" label-for="passwordInput">
                <b-form-input id="passwordInput" type="password" v-model="loginForm.password" required></b-form-input>
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

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.FormHelpers],
        data(){
	    	return {
			    loginForm:{
				    email:'',
				    password:'',
				    remember_me:false
			    },
                submitDisabled: false
		    }
        },
        methods:{
	        onSubmit(){
	        	this.submitDisabled = true;

		        axios.post(this.route('login'), this.loginForm)
                    .then(this.handleSubmitResponse)
                    .catch(this.handleSubmitResponse);
            }
        }
    }
</script>