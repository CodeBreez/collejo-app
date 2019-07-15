<template>
    <assign-student-class :classes="classes" :entity="entity"></assign-student-class>
</template>

<script>

    Vue.component('assign-student-class', require('./AssignStudentClass'));

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.FormHelpers],

        props:{
            classes: Array,
        },

        data(){

            return {
                action: this.entity ? this.route('student.classes.edit', this.entity.id) : null
            }
        },

    }
</script>