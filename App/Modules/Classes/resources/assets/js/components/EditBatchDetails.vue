<template>
    <b-form @submit.prevent="onSubmit" novalidate>

       <div class="col-md-6">
           <b-form-group :label="trans('classes::batch.name')">

               <b-form-input type="text"
                             @input="$v.form.name.$touch()"
                             v-model="form.name"
                             :placeholder="trans('classes::batch.name_placeholder')"></b-form-input>

               <div class="invalid-feedback" v-if="$v.form.name.$dirty && !$v.form.name.required">
                   {{trans('base::validation.required', trans('classes::batch.name'))}}
               </div>

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
	    data(){
		    return {
                newAction: 'batch.new',
                updateAction: ['batch.details.edit', this.entity.id]
		    }
	    }
    }
</script>