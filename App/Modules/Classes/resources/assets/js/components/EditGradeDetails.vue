<template>
    <b-form @submit.prevent="onSubmit">

       <div class="col-md-6">

           <c-form-input type="text"
                         v-model="form.name"
                         name="name"
                         :label="trans('classes::grade.name')"
                         :placeholder="trans('classes::grade.name_placeholder')"
                         :validator="$v"></c-form-input>

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
            grade: {
                default: null,
                type: Object
            }
        },

        data(){

            return {
                action: this.entity ? this.route('grade.details.edit', this.entity.id) : this.route('grade.new')
            }
        }
    }
</script>