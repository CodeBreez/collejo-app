<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" @sort-changed="sortingChanged" responsive no-local-sorting>

            <template slot="name" slot-scope="row">
                <a :href="route('role.edit', row.item.id)">{{row.value}}</a>
            </template>

            <template slot="permissions" slot-scope="row">

                <span class="badge badge-secondary" v-for="permission in row.value">{{permission.name}}</span>

            </template>

            <template slot="updated_at" slot-scope="row">
                {{dateFormat(dateToUserTz(row.value))}}
            </template>

        </b-table>

        <b-pagination-nav v-if="this.roles && this.roles.total > this.roles.per_page" align="center" :link-gen="linkGen" :base-url="baseUrl"
                          :number-of-pages="totalPages" v-model="currentPage"></b-pagination-nav>

    </div>
</template>

<script>

    export default {

        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.PaginationHelper, C.mixins.TableHelper, C.mixins.DateTimeHelpers],

        props: {
            roles: Object
        },

        mounted() {

            if (this.roles && this.roles.data) {

                this.items = this.roles.data;

                this.createPaginationProps(this.roles);
            }
        },

        data() {

            return {
                items: null,
                fields: [
                    {
                        key: 'name',
                        label: this.trans('acl::role.name'),
                        sortable: true
                    }, {
                        key: 'permissions',
                        label: this.trans('acl::role.permissions'),
                        tdAttr: {
                            width:'70%'
                        }
                    }, {
                        key: 'updated_at',
                        label: this.trans('acl::role.updated_at'),
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