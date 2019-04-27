<template>
    <b-form @submit.prevent="onSubmit" novalidate>

        <div class="col-md-6">

            <c-form-input type="text"
                          v-model="form.name"
                          name="name"
                          :label="trans('employees::employee_grade.name')"
                          :validator="$v"></c-form-input>

            <c-form-input type="text"
                          v-model="form.code"
                          name="code"
                          :label="trans('employees::employee_grade.code')"
                          :validator="$v"></c-form-input>

            <c-form-input type="number"
                          v-model="form.priority"
                          name="priority"
                          :label="trans('employees::employee_grade.priority')"
                          :validator="$v"></c-form-input>

            <c-form-input type="number"
                          v-model="form.max_sessions_per_day"
                          name="max_sessions_per_day"
                          :label="trans('employees::employee_grade.max_sessions_per_day')"
                          :validator="$v"></c-form-input>

            <c-form-input type="number"
                          v-model="form.max_sessions_per_week"
                          name="max_sessions_per_week"
                          :label="trans('employees::employee_grade.max_sessions_per_week')"
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
                action: this.entity ? this.route('employee_grade.details.edit', this.entity.id) : this.route('employee_grade.new')
            }
        },

    }
</script>