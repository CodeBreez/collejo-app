<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" @sort-changed="sortingChanged" responsive no-local-sorting>

            <template slot="name" slot-scope="row">
                <a :href="route('user.details.view', row.item.id)">{{row.item.first_name}} {{row.item.last_name}}</a>
            </template>

            <template slot="email" slot-scope="row">
                {{row.value}}
            </template>

            <template slot="created_at" slot-scope="row">
                {{dateFormat(dateToUserTz(row.value))}}
            </template>

        </b-table>

        <b-pagination-nav v-if="this.users && this.users.total > this.users.per_page" align="center" :link-gen="linkGen" :base-url="baseUrl"
                          :number-of-pages="totalPages" v-model="currentPage"></b-pagination-nav>

        <div class="placeholder-row" v-if="!items">
            <div class="placeholder">{{ trans('acl::user.empty_list') }}</div>
        </div>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.PaginationHelper, C.mixins.TableHelper, C.mixins.DateTimeHelpers],

        props: {
            users: Object
        },

        mounted() {

            if (this.users && this.users.data) {

                this.items = this.users.data;

                this.createPaginationProps(this.users);
            }
        },

        data() {

            return {
                items: null,
                fields: [
                    {
                        key: 'name',
                        label: this.trans('acl::user.name'),
                        sortable: true
                    }, {
                        key: 'email',
                        label: this.trans('acl::user.email'),
                        sortable: true
                    }, {
                        key: 'created_at',
                        label: this.trans('acl::user.created_at'),
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