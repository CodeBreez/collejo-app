<template>
    <div class="terms-list">

        <b-form @submit.prevent="onSubmit" novalidate>
            <table class="table">
                <thead>
                    <tr>
                        <th class="border-0" v-for="(field, index) in tableFields" :key="index" scope="col">{{field.label}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(term, index) in terms" :key="index">
                        <td>
                            <b-form-input type="text"
                                          v-model="term.name"
                                          name="name"></b-form-input>
                        </td>
                        <td>
                            <datepicker input-class="form-control" v-model="term.start_date"
                                        :format="getCalendarFormat()">
                            </datepicker>
                        </td>
                        <td>
                            <datepicker input-class="form-control" v-model="term.end_date"
                                        :format="getCalendarFormat()">
                            </datepicker>
                        </td>
                        <td>
                            <b-button size="sm" variant="danger" :title="trans('classes::term.delete')"
                            @click="removeRow(index)">
                                <i class="fa fa-fw fa-trash"></i>
                            </b-button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="align-right">
                            <b-button @click="addNewRow()">{{ trans('base::common.add_row') }}</b-button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="col-md-12">
                <b-button type="submit" :disabled="submitDisabled" variant="primary">{{ trans('base::common.save') }}</b-button>
            </div>
        </b-form>
    </div>
</template>

<script>

    import ViewBatchTerms from './ViewBatchTerms.vue';
    import Datepicker from 'vuejs-datepicker';

    export default {

        components: {
            Datepicker
        },

        extends: ViewBatchTerms,

        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.FormHelpers, C.mixins.DateTimeHelpers],

        props:{
            validation: Object,
            batch: Object
        },

        data(){

            return {
                submitDisabled: false,
                deleted: []
            }
        },

        mounted(){

            if(!this.terms.length){

                this.addNewRow();
            }
        },

        methods:{

            onSubmit(){

                this.submitDisabled = true;

                const requests = [];

                this.terms.forEach((term, index) => {

                    const action = term.id ? this.route('batch.term.edit', {
                        id: this.batch.id,
                        tid: term.id
                    }) : this.route('batch.term.new', this.batch.id);

                    requests.push(new Promise((resolve, reject) => {

                        axios.post(action, term)
                            .then(response => {

                                this.terms[index] = response.data.data.term;

                                resolve();
                            })
                            .catch(reject)
                    }));
                });

                this.deleted.forEach(id => {

                    requests.push(new Promise((resolve, reject) => {

                        axios.delete(this.route('batch.term.delete', {
                            id: this.batch.id,
                            tid: id
                        }))
                        .then(() => {

                            resolve();
                        })
                        .catch(reject)
                    }));
                });

                Promise.all(requests).then(() => {

                    this.submitDisabled = false;
                    this.deleted = [];

                    window.C.notification.success(this.trans('classes::term.terms_updated'));

                }).catch(this.handleSubmitResponse);
            },

            removeRow(index){

                if(this.terms[index]){

                    if(this.terms[index].id){

                        this.deleted.push(this.terms[index].id);
                    }

                    this.terms.splice(index, 1);
                }

            },

            addNewRow(){

                this.terms.push({
                    name:null,
                    start_date:null,
                    end_date:null
                });

            }
        }
    }
</script>