<template>
    <b-form @submit.prevent="onSubmit" novalidate>

        <div class="col-md-6">

            <c-form-input type="text"
                          v-model="form.name"
                          name="name"
                          :label="trans('employees::employee_category.name')"
                          :validator="$v"></c-form-input>

            <c-form-input type="text"
                          v-model="form.code"
                          name="code"
                          :label="trans('employees::employee_category.code')"
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
                action: this.entity ? this.route('employee_category.details.edit', this.entity.id) : this.route('employee_category.new')
            }
        },

    }
</script>