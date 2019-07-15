<template>
    <div class="form-auth">

        <b-form @submit.prevent="onSubmit" novalidate>

            <div class="text-center">
                <div class="auth-logo"></div>
            </div>

            <h2 class="text-center brand-text">{{trans('auth::auth.app_name')}}</h2>

            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> {{ trans('auth::auth.reauth_msg') }}
            </div>

            <c-form-input type="password"
                              v-model="form.password"
                              name="password"
                              :label="trans('auth::auth.password')"
                              :validator="$v"></c-form-input>

            <b-button type="submit" :disabled="submitDisabled" variant="primary" block>
                {{ trans('base::common.continue') }}
            </b-button>
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
                action: this.route('auth.reauth'),
                form: {
                    password: null
			    }
		    }
        }
    }
</script>