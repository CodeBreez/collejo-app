<template>
    <b-card-group deck>

        <term v-for="(term, index) in termsList" :key="index" :term="term" @delete="handleDelete(index)"
              @edit="handleEdit(index)"></term>

        <b-card bg-variant="light" class="text-center">
            <b-button @click.prevent="addNewTerm" variant="link">Add Term</b-button>
        </b-card>

        <b-modal v-if="currentTerm" ref="editTermPopup" :title="currentTerm.name" @ok="handleSave" no-close-on-backdrop
                 no-close-on-esc>
            <b-form>

                <b-form-group label="Name">

                    <b-form-input type="text" v-model="currentTerm.name" required placeholder="New Term">
                    </b-form-input>

                </b-form-group>

                <b-form-group label="Name">

                    <datepicker input-class="form-control" v-model="currentTerm.start_date" required>
                    </datepicker>

                </b-form-group>

                <b-form-group label="Name">

                    <datepicker input-class="form-control" v-model="currentTerm.end_date" required>
                    </datepicker>

                </b-form-group>

            </b-form>
        </b-modal>

    </b-card-group>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    Vue.component('term', require('./EditTerms'));

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

                this.terms.splice(this.currentIndex, 1)
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

                axios.post(this.getRouteForObject(), this.currentTerm)
                    .then(this.handleSubmitResponse)
                    .then(response => {

                        this.currentTerm.id = response.data.data.term.id;

                        this.$set(this.terms, this.currentIndex, Object.assign({}, this.currentTerm));

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