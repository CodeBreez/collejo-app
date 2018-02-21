<template>
    <b-card-group deck>

        <term v-for="(term, index) in termsList" :key="index" :term="term" @delete="handleDelete(index)"
              @edit="handleEdit(index)"></term>

        <b-card bg-variant="light" class="text-center">
            <b-button @click.prevent="addNewTerm" variant="link">
                <i class="fa fa-2x fa-plus"></i>
                <br/>{{trans('classes::term.new_term')}}
            </b-button>
        </b-card>

        <b-modal v-if="currentTerm" ref="editTermPopup" :bvEvt="bvEvt" :title="currentTerm.name" @ok="handleSave"
                 no-close-on-backdrop
                 no-close-on-esc>
            <b-form>

                <b-form-group :label="trans('classes::term.name')">

                    <b-form-input type="text" v-model="currentTerm.name" v-validate="'required'"
                                  :placeholder="trans('classes::term.new_term_placeholder')">
                    </b-form-input>

                </b-form-group>

                <b-form-group :label="trans('classes::term.start_date')">

                    <datepicker input-class="form-control" v-model="currentTerm.start_date" v-validate="'required'">
                    </datepicker>

                </b-form-group>

                <b-form-group :label="trans('classes::term.end_date')">

                    <datepicker input-class="form-control" v-model="currentTerm.end_date" v-validate="'required'">
                    </datepicker>

                </b-form-group>

            </b-form>
        </b-modal>

    </b-card-group>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    Vue.component('term', require('./EditTerm'));

    export default {
        components: {
            Datepicker
        },
        mixins: [C.mixins.Routes, C.mixins.Trans],
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
                bvEvt: null
            }
        },
        mounted() {

            this.termsList = this.terms;
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

                setTimeout(() => {

                    this.$refs.editTermPopup.show();
                }, 100)
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

            handleSave() {

                this.$validator.validateAll().then(result => {

                    if (!result) {
                        window.C.notification.warning(this.trans('base::common.validation_failed'));

                        this.bvEvt.preventDefault()
                    }

                    axios.post(this.getRouteForObject(), this.currentTerm)
                        .then(this.handleSubmitResponse)
                        .then(response => {

                            this.currentTerm.id = response.data.data.term.id;

                            this.$set(this.terms, this.currentIndex, Object.assign({}, this.currentTerm));

                        })
                        .catch(this.handleSubmitResponse);
                });

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