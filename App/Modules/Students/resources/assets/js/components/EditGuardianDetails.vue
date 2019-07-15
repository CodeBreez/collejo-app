<template>
    <b-form @submit.prevent="onSubmit" novalidate>

        <div class="col-md-6">

            <c-form-input type="text"
                          v-model="form.first_name"
                          name="first_name"
                          :label="trans('students::guardian.first_name')"
                          :validator="$v"></c-form-input>

            <c-form-input type="text"
                          v-model="form.last_name"
                          name="last_name"
                          :label="trans('students::guardian.last_name')"
                          :validator="$v"></c-form-input>

            <c-form-input type="text"
                          v-model="form.ssn"
                          name="ssn"
                          :label="trans('students::guardian.ssn')"
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

        data(){

            return {
                action: this.entity ? this.route('guardian.details.edit', this.entity.id) : this.route('guardian.new')
            }
        },

    }
</script>