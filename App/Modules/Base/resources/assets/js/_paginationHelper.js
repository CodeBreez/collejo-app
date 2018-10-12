const PaginationHelper = {

    data() {

        return {
            totalPages: null,
            currentPage: null,
            baseUrl: null
        };
    },

    methods: {

        /**
         * Handles the pagination data properties for lists
         *
         * @param list
         */
        createPaginationProps(list) {

            this.totalPages = Math.ceil(list.total / list.per_page);
            this.currentPage = list.current_page;
            this.baseUrl = list.path;
        },

        /**
         * Generates links bases on page number
         */
        linkGen(pageNum) {

            return `?page=${pageNum}&${window.location.search.replace('?','')}`;
        }
    }
};

export {PaginationHelper};