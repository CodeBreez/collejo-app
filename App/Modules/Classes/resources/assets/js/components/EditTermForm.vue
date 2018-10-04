<template>
    <b-modal v-if="form" :title="form.name"
             @ok="handleOk"
             @cancel="handleCancel"
             :busy="busy"
             no-close-on-backdrop v-model="popupOpen"
             no-close-on-esc>

        <b-form @submit.prevent="handleSubmit" novalidate>

            <c-form-input type="text"
                          v-model="form.name"
                          name="name"
                          :label="trans('classes::term.name')"
                          :placeholder="trans('classes::term.new_term_placeholder')"
                          :validator="$v"></c-form-input>

            <c-form-input type="date"
                          v-model="form.start_date"
                          name="start_date"
                          :label="trans('classes::term.start_date')"
                          :validator="$v"></c-form-input>

            <c-form-input type="date"
                          v-model="form.end_date"
                          name="end_date"
                          :label="trans('classes::term.end_date')"
                          :validator="$v"></c-form-input>

        </b-form>
    </b-modal>

</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.FormHelpers],

        props:{
            batch: null,
            validation: Object,
            modalOpen: false,
            entity: {
                default: null,
                type: Object
            },
        },

        data(){

            return {
                form: {},
                popupOpen: false,
                busy: false
            }
        },

        mounted(){

            this._updateEntity();
        },


        watch: {
            modalOpen (){

                this._updateEntity();
            }
        },

        methods: {

            _updateEntity(){

                this.setFormObject();
                this.form = this.entity;
                this.busy = false;

                this.popupOpen = this.modalOpen;
            },

            getRouteForObject() {

                if (!this.form.id) {

                    return this.route('batch.term.new', this.batch.id);
                } else {

                    return this.route('batch.term.edit', {
                        id: this.batch.id,
                        tid: this.form.id
                    });
                }
            },

            handleSubmit() {

                this.busy = true;

                axios.post(this.getRouteForObject(), this.form)
                    .then(this.handleSubmitResponse)
                    .then(response => {

                        this.form.id = response.data.data.term.id;

                        this.$emit('saved', this.form);
                    })
                    .catch(this.handleSubmitResponse);
            },

            handleOk(e) {

                e.preventDefault();

                this.$v.$touch();

                if(this.$v.form.$error){

                    window.C.notification.warning(this.trans('base::common.validation_failed'));
                } else {

                    this.handleSubmit();
                }

            },

            handleCancel(){

                this.$emit('cancel');
            }
        }
    }
</script>