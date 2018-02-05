const Notification = {

    methods: {

        /**
         * Show a success message
         *
         * @param message
         * @param dismissible
         */
        success(message, dismissible = true) {

            this._showMessage({
                message: message,
                dismissible: dismissible
            })
        },

        /**
         * Show a danger message
         *
         * @param message
         * @param dismissible
         */
        danger(message, dismissible = true) {

            this._showMessage({
                message: message,
                dismissible: dismissible,
                variant: 'danger'
            })
        },

        /**
         * Show a warning message
         *
         * @param message
         * @param dismissible
         */
        warning(message, dismissible = true) {

            this._showMessage({
                message: message,
                dismissible: dismissible,
                variant: 'warning'
            })
        },

        /**
         * Show a info message
         *
         * @param message
         * @param dismissible
         */
        info(message, dismissible = true) {

            this._showMessage({
                message: message,
                dismissible: dismissible,
                variant: 'info'
            })
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
