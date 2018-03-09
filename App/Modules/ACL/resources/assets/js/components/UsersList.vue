<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" responsive no-local-sorting>

            <template slot="name" slot-scope="row">
                {{row.item.first_name}} {{row.item.last_name}}
            </template>

            <template slot="email" slot-scope="row">
                <a :href="route('user.details.view', row.item.id)">{{row.value}}</a>
            </template>

        </b-table>

        <b-pagination-nav v-if="items" align="center" :link-gen="linkGen" :base-url="baseUrl"
                          :number-of-pages="totalPages" v-model="currentPage"></b-pagination-nav>

        <div class="placeholder-row" v-if="!items">
            <div class="placeholder">{{ trans('acl::user.empty_list') }}</div>
        </div>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.PaginationHelper, C.mixins.DateTimeHelpers],
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
                        label: this.trans('acl::user.name')
                    }, {
                        key: 'email',
                        label: this.trans('acl::user.email')
                    }, {
                        key: 'actions',
                        label: this.trans('base::common.actions')
                    }
                ],
            }
        }
    }
</script>