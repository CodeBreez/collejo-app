import { required, requiredIf, requiredUnless, minLength, maxLength, minValue, maxValue, between, alpha, alphaNum, numeric, integer, decimal, email, ipAddress, macAddress, sameAs, url, or, and, not, withParams } from 'vuelidate/lib/validators'

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
            action: null,
            submitDisabled: false,
            form: {}
        }
    },

    mounted(){

        this.setFormObject();
    },

    /**
     * Dynamically convert laravel validation in to vuelidate
     *
     * @return {{form: *}}
     */
    validations(){

        const rulesMap = {
            required: required,
            requiredIf: requiredIf,
            requiredUnless: requiredUnless,
            minLength: minLength,
            maxLength: maxLength,
            minValue: minValue,
            maxValue: maxValue,
            between: between,
            alpha: alpha,
            alphaNum: alphaNum,
            numeric: numeric,
            integer: integer,
            decimal: decimal,
            email: email,
            ipAddress: ipAddress,
            macAddress: macAddress,
            sameAs: sameAs,
            url: url,
            or: or,
            and: and,
            not: not,
            withParams: withParams,
        };

        this._getFormFields().forEach(field => {

            _.keys(this.validation[field]).forEach(rule => {

                if(rulesMap[rule]){

                    this.validation[field][rule] = rulesMap[rule];
                } else{

                    console.error(`Validation rule "${rule}" is called but not defined`)
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
            /*const form = {};

            if(this.entity){

                this._getFormFields().forEach(field => {

                    form[field] = this.entity[field];
                });
            }

            this.form = form;*/

            this.form = Object.assign({}, this.entity);
        },

        /**
         * Before submit validate
         */
        onSubmit(){

            if(!this.$v.form.$error){

                this.submitDisabled = true;

                if(this.action){

                    axios.post(this.action, this.form)
                        .then(this.handleSubmitResponse)
                        .catch(this.handleSubmitResponse);
                }else{

                    console.error('form does not have an action');
                }
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
                    } else if (response.data.errors) {

                        window.C.notification.danger(response.data.message);
                    }

                    if (response.data.success) {

                        window.C.notification.success(response.data.message);
                    }
                }
            }

            return response;
        }
    }
};

export {FormHelpers};