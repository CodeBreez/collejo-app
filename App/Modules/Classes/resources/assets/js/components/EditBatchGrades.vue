<template>
    <b-form @submit.prevent="onSubmit">

        <div class="col-md-6">
            <b-form-checkbox v-model="grade.checked" v-for="(grade, index) in batchGrades" :key="grade.id">
                {{grade.name}}
            </b-form-checkbox>
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
            },
            grades: {
                default: [],
                type: Array
            }
        },
        data(){
            return {
                action: this.route('batch.grades.edit', this.batch.id),
                batchGrades: [],
                submitDisabled:false
            }
        },
        mounted(){
            this.batchGrades = this.grades.map(grade => {
                return {
                    name: grade.name,
                    checked: this.batch.grades.map(g => {
                        return g.id;
                    }).indexOf(grade.id) >= 0,
                    id: grade.id
                }
            });
        },
        methods:{
            onSubmit(){
                this.submitDisabled = true;

                axios.post(this.action, {
                        grades: this.batchGrades.filter(grade => {
                            return grade.checked;
                        }).map(grade => {
                            return grade.id;
                        })
                    })
                    .then(this.handleSubmitResponse)
                    .catch(this.handleSubmitResponse);
            }
        }
    }
</script>