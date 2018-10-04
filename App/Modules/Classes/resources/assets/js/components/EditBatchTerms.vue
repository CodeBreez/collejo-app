<template>
    <b-card-group deck>

        <edit-term v-for="(term, index) in termsList"
                   :key="index"
                   :term="term"
                   @delete="handleDelete(index)"
                    @edit="handleEdit(index)"></edit-term>

        <b-card bg-variant="light" class="text-center">
            <b-button @click.prevent="addNewTerm" variant="link">
                <i class="fa fa-2x fa-plus"></i><br/>{{trans('classes::term.new_term')}}
            </b-button>
        </b-card>


        <term-form @saved="handleSaved"
                   @show="handleShow"
                   @cancel="handleCancel"
                   :entity="currentTerm"
                   :batch="batch"
                    :validation="validation"
                    :modalOpen="modalOpen"></term-form>

    </b-card-group>
</template>

<script>

    Vue.component('edit-term', require('./EditTerm'));
    Vue.component('term-form', require('./EditTermForm'));

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans],

        props: {
            validation: Object,
            batch: {
                default: {},
                type: Object
            },
            terms: {
                default: [],
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

        methods: {

            addNewTerm() {

                this.termsList.push(null);

                this.handleEdit(this.termsList.length);
            },

            handleDelete(index) {

                this.currentIndex = index;

                axios.delete(this.route('batch.term.delete', {
                    id: this.batch.id,
                    tid: this.termsList[this.currentIndex].id
                }))
                    .then(this.handleSubmitResponse)
                    .then(response => {

                        this.termsList.splice(this.currentIndex, 1);

                    })
                    .catch(this.handleSubmitResponse);
            },

            handleShow() {

                this.modalOpen = true;
            },

            handleEdit(index) {

                this.setCurrentTerm(index);

                this.modalOpen = true;
            },

            handleCancel(){

                if(_.filter(_.values(_.pick(this.currentTerm, _.keys(this.validation))), (item) => {
                    return item;
                }).length <= 0){

                    this.termsList = _.slice(this.termsList, 0, this.termsList.length - 1);
                }

                this.modalOpen = false;

            },

            setCurrentTerm(index) {

                this.currentIndex = index;

                this.currentTerm = Object.assign({}, this.termsList[this.currentIndex]);
            },

            handleSaved(form){

                this.$set(this.termsList, this.currentIndex, Object.assign({}, form));

                this.currentTerm = null;

                this.modalOpen = false;
            },
        }
    }
</script>