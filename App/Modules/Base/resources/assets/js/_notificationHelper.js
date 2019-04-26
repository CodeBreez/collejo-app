const Notification = {

    methods: {

        /**
         * Show a success message
         *
         * @param message
         * @param dismissible
         * @param msgDetails
         */
        success(message, dismissible = true, msgDetails = null) {

            this._showMessage({
                message,
                msgDetails,
                dismissible
            });
        },

        /**
         * Show a danger message
         *
         * @param message
         * @param dismissible
         * @param msgDetails
         */
        danger(message, dismissible = true, msgDetails = null) {

            this._showMessage({
                message,
                msgDetails,
                dismissible,
                variant: 'danger'
            });
        },

        /**
         * Show a warning message
         *
         * @param message
         * @param dismissible
         * @param msgDetails
         */
        warning(message, dismissible = true, msgDetails = null) {

            this._showMessage({
                message,
                msgDetails,
                dismissible,
                variant: 'warning'
            });
        },

        /**
         * Show a info message
         *
         * @param message
         * @param dismissible
         * @param msgDetails
         */
        info(message, dismissible = true, msgDetails = null) {

            this._showMessage({
                message,
                msgDetails,
                dismissible,
                variant: 'info'
            });
        },

        /**
         * Show message with given options
         *
         * @param options
         */
        _showMessage(options) {

            this.notifications.push(Object.assign({
                show: 5,
                variant: 'success',
                dismissible: true,
                dismissLabel: 'Close'
            }, options));
        }
    }
};

export {Notification};
