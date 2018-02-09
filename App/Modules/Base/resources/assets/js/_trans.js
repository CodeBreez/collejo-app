const Trans = {

	methods:{

        /**
         * Translate a given string
         *
         * @param string
         * @returns {*}
         */
        trans(string){

            const parts = string.split('::');
            const module = parts[0];
            const path = parts[1];

            return _.get(this.getModuleLangObject(module), path, string);
        },

        /**
         * Returns the language string for the given module
         *
         * @param module
         * @returns {*}
         */
        getModuleLangObject(module){

            if(this.getCurrentLanguage() !== 'en'){

                return _.merge(C.langs['en'][module], C.langs[this.getCurrentLanguage()][module]);
            }

            return C.langs[this.getCurrentLanguage()][module];
        },

        /**
         * Returns the current language set in the document
         *
         * @returns {*}
         */
        getCurrentLanguage(){

            return document.documentElement.lang;
        }
	},

};

export { Trans };