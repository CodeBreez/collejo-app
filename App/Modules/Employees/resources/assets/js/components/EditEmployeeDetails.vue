<template>
    <b-form @submit.prevent="onSubmit" novalidate>

        <div class="col-md-6">

            <media-uploader v-model="form.image_id"
                            :label="trans('employees::employee.employee_image')"
                            bucket="employee_pictures"></media-uploader>

            <c-form-input type="date"
                          v-model="form.joined_on"
                          name="joined_on"
                          :label="trans('employees::employee.joined_on')"
                          :validator="$v"></c-form-input>

            <c-form-input type="text"
                          v-model="form.employee_number"
                          name="employee_number"
                          :label="trans('employees::employee.employee_number')"
                          :validator="$v"></c-form-input>

            <c-form-input type="text"
                          v-model="form.first_name"
                          name="first_name"
                          :label="trans('employees::employee.first_name')"
                          :validator="$v"></c-form-input>

            <c-form-input type="text"
                          v-model="form.last_name"
                          name="last_name"
                          :label="trans('employees::employee.last_name')"
                          :validator="$v"></c-form-input>

            <c-form-input type="select"
                          v-model="form.employee_position_id"
                          :options="employeePositions"
                          name="employee_position_id"
                          :label="trans('employees::employee.employee_position')"
                          :validator="$v"></c-form-input>

            <c-form-input type="select"
                          v-model="form.employee_department_id"
                          :options="employeeDepartments"
                          name="employee_department_id"
                          :label="trans('employees::employee.employee_department')"
                          :validator="$v"></c-form-input>

            <c-form-input type="select"
                          v-model="form.employee_grade_id"
                          :options="employeeGrades"
                          name="employee_grade_id"
                          :label="trans('employees::employee.employee_grade')"
                          :validator="$v"></c-form-input>

            <c-form-input type="date"
                          v-model="form.date_of_birth"
                          name="date_of_birth"
                          :label="trans('employees::employee.date_of_birth')"
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
            employeePositions: Array,
            employeeDepartments: Array,
            employeeGrades: Array,
        },

        data(){

            return {
                action: this.entity ? this.route('employee.details.edit', this.entity.id) : this.route('employee.new')
            }
        },

    }
</script>