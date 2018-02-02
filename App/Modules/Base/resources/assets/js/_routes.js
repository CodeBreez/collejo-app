const Routes = {

	methods:{

        route(name, params) {

			const routes = this.getRoutes().filter(route => {

				return route.name === name;
			});

			if(routes.length === 1){

                let url = `/${routes[0].uri}`;

                if (typeof params === 'string' || typeof params === 'number') {

                    params = {
                        'id': params
                    }
                }

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

		getRoutes(){

            return JSON.parse('<<ROUTES_OBJECT>>');
		}
	},

};

export { Routes };