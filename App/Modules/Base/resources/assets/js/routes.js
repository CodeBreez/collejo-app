const Routes = {

	methods:{

		route(name){

			const routes = this.getRoutes().filter(route => {
				return route.name === name;
			});

			if(routes.length === 1){

				return routes[0].uri;

			} else {

				console.warn(`Route ${name} is not found`);
			}
		},

		getRoutes(){
			return JSON.parse('<<ROUTES_OBJECT>>');
		}
	},

};

export { Routes };