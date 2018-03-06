<template>
    <b-card-group deck>

        <term v-for="(term, index) in termsList" :key="index" :term="term" @delete="handleDelete(index)"
              @edit="handleEdit(index)"></term>

        <b-card bg-variant="light" class="text-center">
            <b-button @click.prevent="addNewTerm" variant="link">
                <i class="fa fa-2x fa-plus"></i><br/>{{trans('classes::term.new_term')}}
            </b-button>
        </b-card>

        <b-modal v-if="currentTerm" :title="currentTerm.name" @ok="handleOk" @hide="handleHide"
                 no-close-on-backdrop v-model="modalOpen"
                 no-close-on-esc>
            <b-form @submit.prevent="handleSubmit" novalidate>

                <b-form-group :label="trans('classes::term.name')">

                    <b-form-input type="text" v-model="currentTerm.name" @input="$v.currentTerm.name.$touch()"
                                  :placeholder="trans('classes::term.new_term_placeholder')">
                    </b-form-input>
                    <div class="invalid-feedback" v-if="!$v.currentTerm.name.required">
                        {{trans('base::validation.required', trans('classes::term.name'))}}
                    </div>
                </b-form-group>

                <b-form-group :label="trans('classes::term.start_date')">

                    <datepicker input-class="form-control" v-model="currentTerm.start_date"
                                :format="getCalendarFormat()"
                                @input="$v.currentTerm.start_date.$touch()">
                    </datepicker>
                    <div class="invalid-feedback" v-if="!$v.currentTerm.start_date.required">
                        {{trans('base::validation.required', trans('classes::term.start_date'))}}
                    </div>
                </b-form-group>

                <b-form-group :label="trans('classes::term.end_date')">

                    <datepicker input-class="form-control" v-model="currentTerm.end_date"
                                :format="getCalendarFormat()"
                                @input="$v.currentTerm.end_date.$touch()">
                    </datepicker>
                    <div class="invalid-feedback" v-if="!$v.currentTerm.end_date.required">
                        {{trans('base::validation.required', trans('classes::term.end_date'))}}
                    </div>
                </b-form-group>

            </b-form>
        </b-modal>

    </b-card-group>
</template>

<script>

    import Datepicker from 'vuejs-datepicker';
    import { required } from 'vuelidate/lib/validators'

    Vue.component('term', require('./EditTerm'));

    export default {
        components: {
            Datepicker
        },
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.DateTimeHelpers],
        props: {
            batch: {
                default: () => {
                },
                type: Object
            },
            terms: {
                default: () => [],
                type: Array
            }
        },
        data() {
            return {
                termsList: [],
                currentTerm: null,
                currentIndex: null,
                modalOpen: false
            }
        },
        mounted() {

            this.termsList = this.terms;
        },
        validations: {
            currentTerm:{
                name: {
                    required
                },
                start_date: {
                    required
                },
                end_date: {
                    required
                }
            }
        },
        methods: {

            addNewTerm() {

                this.termsList.push({
                    id: null,
                    name: null,
                    start_date: null,
                    end_date: null
                });

                this.handleEdit(this.terms.length - 1);
            },

            handleDelete(index) {

                this.setCurrentIndex(index);

                axios.delete(this.route('batch.term.delete', {
                    id: this.batch.id,
                    tid: this.terms[this.currentIndex].id
                }))
                    .then(this.handleSubmitResponse)
                    .then(() => {

                        this.terms.splice(this.currentIndex, 1);
                    })
                    .catch(this.handleSubmitResponse);
            },

            handleEdit(index) {

                this.setCurrentIndex(index);

                this.cloneObject();

                this.modalOpen = true;
            },

            getRouteForObject() {

                if (!this.currentTerm.id) {

                    return this.route('batch.term.new', this.batch.id);
                } else {

                    return this.route('batch.term.edit', {
                        id: this.batch.id,
                        tid: this.currentTerm.id
                    });
                }
            },

            handleOk(e) {
                this.$v.$touch();
                e.preventDefault();

                if(this.$v.currentTerm.$error){
                    window.C.notification.warning(this.trans('base::common.validation_failed'));
                } else {
                    this.handleSubmit();
                }

            },

            handleHide(){
                if(_.filter(_.values(_.pick(this.currentTerm, _.keys(this.$v.currentTerm.$params))), item => {
                    return item;
                    }).length <= 0){
                    this.terms.splice(this.currentIndex, 1);
                }
            },

            handleSubmit() {
                axios.post(this.getRouteForObject(), this.currentTerm)
                    .then(this.handleSubmitResponse)
                    .then(response => {

                        this.currentTerm.id = response.data.data.term.id;

                        this.$set(this.terms, this.currentIndex, Object.assign({}, this.currentTerm));

                        this.modalOpen = false;
                    })
                    .catch(this.handleSubmitResponse);
            },

            cloneObject() {

                this.currentTerm = Object.assign({}, this.terms[this.currentIndex]);
            },

            setCurrentIndex(index) {

                this.currentIndex = index;
            }
        }
    }
</script>