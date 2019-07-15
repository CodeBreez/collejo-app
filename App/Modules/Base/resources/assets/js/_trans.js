const Trans = {

	methods:{

        /**
         * Translate a given string
         *
         * @param string
         * @param params
         * @returns {*}
         */
        trans(string, params){

            const parts = string.split('::');
            const module = parts[0];
            const path = parts[1];

            // Get the trans line from the trans object
            let transString = _.get(this.getModuleLangObject(module), path, string);

            const re = /(?:^|\W):(\w+)(?!\w)/g;
            const matches = [];
            let match;

            // Find any keys we need to parse
            while (match = re.exec(transString)) {

                matches.push(match[1]);
            }

            let paramsObj = {};

            // If the passed params are a string or a number
            // we create the params object
            if ((typeof params === 'string' || typeof params === 'number')
                && matches.length) {

                paramsObj[matches[0]] = params;
            }

            // Parse values in to keys in to the trans line
            _.each(Object.keys(paramsObj), key => {

                const pattern = new RegExp(`:${key}`);

                transString = transString.replace(pattern, paramsObj[key]);
            });

            return transString;
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