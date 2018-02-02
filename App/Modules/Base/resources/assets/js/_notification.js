const Notification = {

    methods: {

        success(message, dismissible = true) {

            this._showMessage({
                message: message,
                dismissible: dismissible
            })
        },

        danger(message, dismissible = true) {

            this._showMessage({
                message: message,
                dismissible: dismissible,
                variant: 'danger'
            })
        },

        warning(message, dismissible = true) {

            this._showMessage({
                message: message,
                dismissible: dismissible,
                variant: 'warning'
            })
        },

        info(message, dismissible = true) {

            this._showMessage({
                message: message,
                dismissible: dismissible,
                variant: 'info'
            })
        },

        _showMessage(options) {

            this.notifications.push(Object.assign({
                show: true,
                variant: 'success',
                dismissible: true,
                dismissLabel: 'Close',
                dismissCountDown: 0,
                dismissSecs: 5
            }, options));
        }

    },

};

export {Notification};
