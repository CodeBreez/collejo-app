const Trans = {

    methods: {

        /**
         * Translates a given string with params
         *
         * @param string
         * @param params
         */
        trans(string, params) {

            const parts = string.split('::');
            const module = parts[0];
            const path = parts[1];

            const transString = _.get(this.getModuleLangObject(module), path, string);

            if (typeof params === 'string' || typeof params === 'number') {

                params = {
                    'id': params
                }
            }
        },

        /**
         * Returns a language object by module name
         *
         * @param module
         * @return {*}
         */
        getModuleLangObject(module) {

            if (this.getCurrentLanguage() !== 'en') {

                return _.merge(C.langs['en'][module], C.langs[this.getCurrentLanguage()][module]);
            }

            return C.langs[this.getCurrentLanguage()][module];
        },

        /**
         * Returns the current language from dom
         *
         * @return {*}
         */
        getCurrentLanguage() {

            return document.documentElement.lang;
        }
    },

};

export {Trans};