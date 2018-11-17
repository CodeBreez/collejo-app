<template>
    <b-form @submit.prevent="onSubmit" novalidate>

        <div class="col-md-6">

            <media-uploader></media-uploader>

            <c-form-input type="date"
                          v-model="form.admitted_on"
                          name="admitted_on"
                          :label="trans('students::student.admitted_on')"
                          :validator="$v"></c-form-input>

            <c-form-input type="text"
                          v-model="form.first_name"
                          name="first_name"
                          :label="trans('students::student.first_name')"
                          :validator="$v"></c-form-input>

            <c-form-input type="text"
                          v-model="form.last_name"
                          name="last_name"
                          :label="trans('students::student.last_name')"
                          :validator="$v"></c-form-input>

            <c-form-input type="date"
                          v-model="form.date_of_birth"
                          name="date_of_birth"
                          :label="trans('students::student.date_of_birth')"
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
                action: this.entity ? this.route('student.details.edit', this.entity.id) : this.route('student.new')
            }
        }
    }
</script>