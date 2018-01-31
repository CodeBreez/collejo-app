<template>
    <b-form @submit.prevent="onSubmit">

       <div class="col-md-6">
           <b-form-group :label="trans('classes::grade.name')">

               <b-form-input type="text" v-model="form.name" :placeholder="trans('classes::grade.name_placeholder')"></b-form-input>

           </b-form-group>
       </div>

        <div class="col-md-12">
            <b-button type="submit" :disabled="submitDisabled" variant="primary">{{ trans('base::common.save') }}</b-button>
        </div>

    </b-form>
</template>

<script>

    export default {
	    mixins: [ C.mixins.Routes, C.mixins.Trans ],
        props:{
            validation: Object,
            grade: {
                default: null,
                type: Object
            }
        },
	    data(){
		    return {
                form: {
                    name: null
                },
			    submitDisabled:false
		    }
	    },
        mounted() {
            if (this.grade) {
                this.form = this.grade;
            }
        },
	    methods:{
		    onSubmit(){
			    this.submitDisabled = true;

			    axios.post(this.route('batch.new'), this.form)
				    .then(response => {

					    console.log(response)
				    })
				    .catch(errors => {
					    this.submitDisabled = false;
					    console.log(errors)
				    });
		    }
	    }
    }
</script>