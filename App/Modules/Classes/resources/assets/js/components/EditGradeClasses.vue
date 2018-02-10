<template>
    <b-card-group deck>

        <clasis v-for="(clasis, index) in classesList" :key="index" :clasis="clasis" @delete="handleDelete(index)"
                @edit="handleEdit(index)"></clasis>

        <b-card bg-variant="light" class="text-center">
            <b-button @click.prevent="addNewTerm" variant="link">
                <i class="fa fa-2x fa-plus"></i>
                <br/>{{trans('classes::class.new_class')}}
            </b-button>
        </b-card>

        <b-modal v-if="currentTerm" ref="editTermPopup" :bvEvt="bvEvt" :title="currentTerm.name" @ok="handleSave"
                 no-close-on-backdrop
                 no-close-on-esc>
            <b-form>

                <b-form-group label="Name">

                    <b-form-input type="text" v-model="currentTerm.name" v-validate="'required'" placeholder="New Term">
                    </b-form-input>

                </b-form-group>

                <b-form-group label="Name">

                    <datepicker input-class="form-control" v-model="currentTerm.start_date" v-validate="'required'">
                    </datepicker>

                </b-form-group>

                <b-form-group label="Name">

                    <datepicker input-class="form-control" v-model="currentTerm.end_date" v-validate="'required'">
                    </datepicker>

                </b-form-group>

            </b-form>
        </b-modal>

    </b-card-group>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    Vue.component('clasis', require('./EditClass'));

    export default {
        components: {
            Datepicker
        },
        mixins: [C.mixins.Routes, C.mixins.Trans],
        props: {
            grade: {
                default: () => {
                },
                type: Object
            },
            classes: {
                default: () => [],
                type: Array
            }
        },
        data() {
            return {
                classesList: [],
                currentTerm: null,
                currentIndex: null,
                bvEvt: null
            }
        },
        mounted() {

            this.classesList = this.clasiss;
        },
        methods: {

            addNewTerm() {

                this.classesList.push({
                    id: null,
                    name: null,
                    start_date: null,
                    end_date: null
                });

                this.handleEdit(this.clasiss.length - 1);
            },

            handleDelete(index) {

                this.setCurrentIndex(index);

                axios.delete(this.route('batch.clasis.delete', {
                    id: this.batch.id,
                    tid: this.clasiss[this.currentIndex].id
                }))
                    .then(this.handleSubmitResponse)
                    .then(() => {

                        this.clasiss.splice(this.currentIndex, 1);
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

                    return this.route('batch.clasis.new', this.batch.id);
                } else {

                    return this.route('batch.clasis.edit', {
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

                            this.currentTerm.id = response.data.data.clasis.id;

                            this.$set(this.clasiss, this.currentIndex, Object.assign({}, this.currentTerm));

                        })
                        .catch(this.handleSubmitResponse);
                });

            },

            cloneObject() {

                this.currentTerm = Object.assign({}, this.clasiss[this.currentIndex]);
            },

            setCurrentIndex(index) {

                this.currentIndex = index;
            }
        }
    }
</script>