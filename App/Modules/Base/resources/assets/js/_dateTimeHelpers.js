const DateTimeHelpers = {

    methods: {

        dateFormat(date)
        {
            if(!date){
                return;
            }

            return date.format(this.getDateFormat());
        },

        /**
         * Convert a UTC time to user's tz moment object
         *
         * @param date
         */
        dateToUserTz(date){

            if(!date){
                return;
            }

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

            if(!date){
                return;
            }

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
         * Returns the date format for calendars
         *
         * @returns {string}
         */
        getCalendarFormat()
        {
            return 'MMM dd, yyyy';
        },

        /**
         * Returns how dates should be formatted
         *
         * @returns {string}
         * @private
         */
        getDateFormat()
        {
            return 'MMM D, YYYY';
        },

        /**
         * Returns how time should be formatted
         *
         * @returns {string}
         * @private
         */
        getTimeFormat()
        {
            return 'h:mm a';
        },

        /**
         * Returns how date and time should be formatted
         *
         * @returns {string}
         * @private
         */
        getDateTimeFormat()
        {
            return `${this.getDateFormat()}, ${this.getTimeFormat()}`;
        }
    }
};

export {DateTimeHelpers};