const DateTimeHelpers = {

    methods: {

        dateFormat(date)
        {
            return date.format(this._getDateFormat());
        },

        /**
         * Convert a UTC time to user's tz moment object
         *
         * @param date
         */
        dateToUserTz(date){

            return this.dateToMoment(date).utcOffset(this._getUserTimezoneOffset());
        },

        /**
         * Parse a Carbon Date string in to moment object
         *
         * @param date
         * @param utc
         * @returns {*}
         */
        dateToMoment(date, utc = true){

            if(date.length > 20){
                date = date.substring(0, date.length - 7);
            }

            if(utc){

                return moment.utc(date);
            }

            return moment(date);
        },

        /**
         * Returns the user's time zone offset to UTC
         *
         * @returns {number}
         * @private
         */
        _getUserTimezoneOffset()
        {
            return new Date().getTimezoneOffset();
        },

        /**
         * Returns how dates should be formatted
         *
         * @returns {string}
         * @private
         */
        _getDateFormat()
        {
            return 'MMM D, YYYY';
        },

        /**
         * Returns how time should be formatted
         *
         * @returns {string}
         * @private
         */
        _getTimeFormat()
        {
            return 'h:mm a';
        },

        /**
         * Returns how date and time should be formatted
         *
         * @returns {string}
         * @private
         */
        _getDateTimeFormat()
        {
            return `${this._getDateFormat()}, ${this._getTimeFormat()}`;
        }
    }
};

export {DateTimeHelpers};