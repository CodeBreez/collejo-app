const Routes = {

	methods:{

        /**
         * Parse and return a route by it's name
         *
         * @param name
         * @param params
         * @returns {string}
         */
        route(name, params) {

            const routes = this._getRoutes().filter(route => {

                return route.name === name;
            });

            if(routes.length === 1){

                let url = `/${routes[0].uri}`;

                if (typeof params === 'string' || typeof params === 'number') {

                    params = {
                        'id': params
                    };
                }

                // If parameters are present parse them in to the route
                if (params) {

                    _.each(Object.keys(params), key => {

                        const pattern = new RegExp(`{${key}}`);

                        url = url.replace(pattern, params[key]);
                    });
                }

                return url;

            } else {

                throw Error(`Route ${name} is not found`);
            }
        },

        /**
         * Returns all the registered routes in the system
         *
         * @returns {any}
         * @private
         */
        _getRoutes() {

            return JSON.parse('<<ROUTES_OBJECT>>');
		}
	},

};

export { Routes };