<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" fixed>

            <template slot="name" slot-scope="row">
                <a :href="route('batch.details.view', row.item.id)">{{row.value}}</a>
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
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.PaginationHelper],
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
                        key: 'id',
                        sortable: true
                    }, {
                        key: 'name',
                        sortable: false
                    }, {
                        key: 'actions',
                        label: 'Actions'
                    }
                ],
            }
        }
    }
</script>