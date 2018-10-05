<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" responsive no-local-sorting>

            <template slot="name" slot-scope="row">
                <a :href="route('batch.details.view', row.item.id)">{{row.value}}</a>
            </template>

            <template slot="start" slot-scope="row">
                {{dateFormat(dateToUserTz(row.item.start_date))}}
            </template>

            <template slot="end" slot-scope="row">
                {{dateFormat(dateToUserTz(row.item.end_date))}}
            </template>

            <template slot="actions" slot-scope="row">
                <b-button v-b-tooltip variant="outline-secondary" :title="trans('classes::batch.view_terms')"
                          :href="route('batch.terms.view', row.item.id)">
                    {{ trans('classes::term.terms') }}
                </b-button>
                <b-button v-b-tooltip variant="outline-secondary" :title="trans('classes::batch.view_grades')"
                          :href="route('batch.grades.view', row.item.id)">
                    {{ trans('classes::grade.grades') }}
                </b-button>
            </template>
        </b-table>

        <b-pagination-nav v-if="items" align="center" :link-gen="linkGen" :base-url="baseUrl"
                          :number-of-pages="totalPages" v-model="currentPage"></b-pagination-nav>

        <div class="placeholder-row" v-if="!items">
            <div class="placeholder">{{ trans('classes::batch.empty_list') }}</div>
        </div>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.PaginationHelper, C.mixins.DateTimeHelpers],

        props: {
            batches: Object
        },

        mounted() {

            if (this.batches && this.batches.data) {

                this.items = this.batches.data;

                this.createPaginationProps(this.batches);
            }
        },
        data() {

            return {
                items: null,
                fields: [
                    {
                        key: 'name',
                        label: this.trans('classes::batch.name')
                    }, {
                        key: 'start',
                        label: this.trans('classes::batch.batch_start')
                    },{
                        key: 'end',
                        label: this.trans('classes::batch.batch_end')
                    }, {
                        key: 'actions',
                        label: this.trans('base::common.actions')
                    }
                ],
            }
        }
    }
</script>