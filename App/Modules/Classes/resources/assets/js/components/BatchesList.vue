<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" fixed responsive no-local-sorting>

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
                <b-button size="sm" @click.stop="info(row.item, row.index, $event.target)" class="mr-1">
                    Info modal
                </b-button>
                <b-button size="sm" @click.stop="row.toggleDetails">
                    {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
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
                        sortable: true,
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