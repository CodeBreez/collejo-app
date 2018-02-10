<template>
    <b-form @submit.prevent="onSubmit">

       <div class="col-md-6">
           <b-form-group :label="trans('classes::batch.name')">

               <b-form-input type="text" v-model="form.name" :placeholder="trans('classes::batch.name_placeholder')"></b-form-input>

           </b-form-group>
       </div>

        <div class="col-md-12">
            <b-button type="submit" :disabled="submitDisabled" variant="primary">{{ trans('base::common.save') }}</b-button>
        </div>

    </b-form>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.FormHelpers],
        props:{
	    	validation: Object,
            batch: {
	    	    default: null,
                type: Object
            }
        },
	    data(){
		    return {
                action: this.route('batch.new'),
                form: {
                    name: null
                },
			    submitDisabled:false
		    }
	    },
        mounted(){
	        if(this.batch){
	            this.form = this.batch;
                this.action = this.route('batch.details.edit', this.batch.id);
            }
        },
	    methods:{
		    onSubmit(){
			    this.submitDisabled = true;

                axios.post(this.action, this.form)
                    .then(this.handleSubmitResponse)
                    .catch(this.handleSubmitResponse);
		    }
	    }
    }
</script>