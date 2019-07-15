const TableHelper = {

    methods: {

        sortingChanged(context){

            const sortFields = this.fields.filter(field => {
                return field.key === context.sortBy;
            });

            window.C.sorting = {
                sortBy: context.sortBy,
                sortByLabel: sortFields.length ? sortFields[0].label : context.sortBy,
                sortDesc: context.sortDesc
            };
        }
    }
};

export {TableHelper};