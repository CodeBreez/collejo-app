const DateTimeHelpers = {

    methods: {

        /**
         * Convert a UTC time to user's tz moment object
         *
         * @param UTCTime
         */
        toUserTz(UTCTime) {

            return moment.utc(UTCTime).utcOffset()
        }
    }
};

export {DateTimeHelpers};