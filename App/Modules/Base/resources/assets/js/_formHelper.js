import { required } from 'vuelidate/lib/validators'

const FormHelpers = {

    props:{
        validation: Object,
        entity: {
            default: null,
            type: Object
        }
    },

    data(){
        return {
            action: this.trans(...this.newAction),
            submitDisabled: false,
            form: {}
        }
    },

    mounted(){
        if(this.entity){
            this.setFormObject();
            this.action = this.trans(...this.updateAction);
        }
    },

    /**
     * Dynamically convert laravel validation in to vuelidate
     *
     * @return {{form: *}}
     */
    validations(){

        const rulesMap = {
            required: required
        };

        this._getFormFields().forEach(field => {

            _.keys(this.validation[field]).forEach(rule => {
                if(rulesMap[rule]){
                    this.validation[field][rule] = rulesMap[rule];
                }
            });
        });

        return {
            form: this.validation
        };
    },

    methods: {

        /**
         * Returns the form fields
         *
         * @return {*}
         * @private
         */
        _getFormFields(){

            return _.keys(this.validation);
        },

        /**
         * Sets the form object bases on the validating fields
         */
        setFormObject(){
            const form = {};

            this._getFormFields().forEach(field => {
                form[field] = this.entity[field];
            });

            this.form = form;
        },

        /**
         * Before submit validate
         */
        onSubmit(){

            if(!this.$v.form.$error){
                this.submitDisabled = true;

                axios.post(this.action, this.form)
                    .then(this.handleSubmitResponse)
                    .catch(this.handleSubmitResponse);
            }
        },

        /**
         * Handles the response for a form submit event
         *
         * @param response
         */
        handleSubmitResponse(response) {

            if (response.response) {
                response = response.response;
            }

            if (response && response.data) {

                if (!response.data.data || !response.data.data.redir) {

                    this.submitDisabled = false;
                }

                if (response.data.message) {

                    if (!response.data.success) {

                        window.C.notification.warning(response.data.message);
                    }

                    if (response.data.errors) {

                        window.C.notification.danger(response.data.message);
                    }

                    if (response.data.success) {

                        window.C.notification.success(response.data.message);
                    }
                }
            }
        }
    }
};

export {FormHelpers};