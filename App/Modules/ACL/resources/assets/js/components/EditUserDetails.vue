<template>
    <b-form @submit.prevent="onSubmit" novalidate>

       <div class="col-md-6">
           <b-form-group :label="trans('acl::user.first_name')">

               <b-form-input type="text" v-model="form.first_name"
                             @input="$v.form.first_name.$touch()"></b-form-input>

               <div class="invalid-feedback" v-if="$v.form.first_name.$dirty && !$v.form.first_name.required">
                   {{trans('base::validation.required', trans('acl::user.first_name'))}}
               </div>

           </b-form-group>
       </div>

        <div class="col-md-12">
            <b-button type="submit" :disabled="submitDisabled" variant="primary">{{ trans('base::common.save') }}</b-button>
        </div>

    </b-form>
</template>

<script>

    import { required, email } from 'vuelidate/lib/validators'

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.FormHelpers],
        props:{
	    	validation: Object,
            user: {
	    	    default: null,
                type: Object
            }
        },
        validations(){
            return this.validation;
        },
	    data(){
		    return {
                action: this.route('user.new'),
                form: {
                    first_name: null
                },
			    submitDisabled:false
		    }
	    },
        mounted(){
	        if(this.user){
	            this.form = this.user;
                this.action = this.route('user.details.edit', this.form.id);
            }
        },
	    methods:{
		    onSubmit(){

                if(!this.$v.form.$error){
                    this.submitDisabled = true;

                    axios.post(this.action, this.form)
                        .then(this.handleSubmitResponse)
                        .catch(this.handleSubmitResponse);
                }
		    }
	    }
    }
</script>