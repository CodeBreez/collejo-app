const Trans = {

	methods:{

		trans(string){

			const parts = string.split('::');
			const module = parts[0];
			const path = parts[1];

			return _.get(this.getModuleLangObject(module), path, '');
		},

		getModuleLangObject(module){

			if(this.getCurrentLanguage() !== 'en'){

				return _.merge(C.langs['en'][module], C.langs[this.getCurrentLanguage()][module]);
			}

			return C.langs[this.getCurrentLanguage()][module];
		},

		getCurrentLanguage(){
			return document.documentElement.lang;
		}
	},

};

export { Trans };