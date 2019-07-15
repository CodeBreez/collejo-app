<template>
    <div class="terms-list">

        <b-table :items="terms" :fields="tableFields" responsive no-local-sorting></b-table>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Trans],

        props: {
            terms: {
                default: [],
                type: Array
            }
        },

        data() {

            return {
                tableFields: [
                    {
                        key: 'name',
                        label: this.trans('classes::term.name')
                    },{
                        key: 'start_date',
                        label: this.trans('classes::term.start_date'),
                        formatter: (value, key, item) => {
                            return this.dateFormat(this.dateToUserTz(value))
                        }
                    },{
                        key: 'end_date',
                        label: this.trans('classes::term.end_date'),
                        formatter: (value, key, item) => {
                            return this.dateFormat(this.dateToUserTz(value))
                        }
                    },
                ],
            }
        },

    }
</script>