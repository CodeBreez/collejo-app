<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" @sort-changed="sortingChanged" responsive no-local-sorting>

            <template slot="name" slot-scope="row">
                <a :href="route('guardian.details.view', row.item.id)">{{row.item.user.name}}</a>
            </template>

        </b-table>

        <b-pagination-nav v-if="this.guardians && this.guardians.total > this.guardians.per_page" align="center" :link-gen="linkGen" :base-url="baseUrl" :number-of-pages="totalPages" v-model="currentPage"></b-pagination-nav>

        <div class="placeholder-row" v-if="!items">
            <div class="placeholder">{{ trans('students::guardian.empty_list') }}</div>
        </div>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.PaginationHelper, C.mixins.TableHelper, C.mixins.DateTimeHelpers],

        props: {
            guardians: Object
        },

        mounted() {

            if (this.guardians && this.guardians.data) {

                this.items = this.guardians.data;

                this.createPaginationProps(this.guardians);
            }
        },

        data() {

            return {
                items: null,
                fields: [
                    {
                        key: 'name',
                        label: this.trans('students::guardian.name'),
                        sortable: true
                    }, {
                        key: 'ssn',
                        label: this.trans('students::guardian.ssn'),
                        sortable: true
                    }, {
                        key: 'actions',
                        label: this.trans('base::common.actions')
                    }
                ],
            }
        }
    }
</script>