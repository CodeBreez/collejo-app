<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields">

        </b-table>

        <div class="placeholder-row" v-if="!items">
            <div class="placeholder">{{ trans('classes::grade.empty_list') }}</div>
        </div>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans],
        props: {
            grades: Object
        },
        mounted() {
            if (this.grades.data) {
                this.items = this.grades.data;
            }
        },
        data() {
            return {
                items: null,
                fields: [
                    {
                        key: 'id',
                        sortable: true
                    }, {
                        key: 'name',
                        sortable: false
                    }
                ],
            }
        }
    }
</script>