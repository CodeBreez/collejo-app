const FormHelpers = {

    methods: {

        /**
         * Handles the response for a form submit event
         *
         * @param response
         */
        handleSubmitResponse(response) {

            if (response.response) {
                response = response.response;
            }

            this.submitDisabled = false;

            if (response && response.data.message) {

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
};

export {FormHelpers};