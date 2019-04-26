const Permissions = {

	methods:{

        /**
         * Check if the user permission is allowed
         *
         * @param permission
         * @returns {string}
         */
        can(permission) {

            return this._getPermissions().indexOf(permission) > -1;
        },

        /**
         * Returns all the registered permissions for the user
         *
         * @private
         */
        _getPermissions() {

            return window.C.permissions;
		}
	},

};

export { Permissions };