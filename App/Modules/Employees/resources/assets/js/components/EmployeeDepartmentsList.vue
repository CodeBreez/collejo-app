<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" @sort-changed="sortingChanged" responsive no-local-sorting>

            <template slot="name" slot-scope="row">
                <a :href="route('employee_department.details.edit', row.item.id)">{{row.item.name}}</a>
            </template>

        </b-table>

        <b-pagination-nav v-if="this.employeeDepartments && this.employeeDepartments.total > this.employeeDepartments.per_page" align="center" :link-gen="linkGen" :base-url="baseUrl" :number-of-pages="totalPages" v-model="currentPage"></b-pagination-nav>

        <div class="placeholder-row" v-if="!items">
            <div class="placeholder">{{ trans('employees::employee_department.empty_list') }}</div>
        </div>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.PaginationHelper, C.mixins.TableHelper, C.mixins.DateTimeHelpers],

        props: {
            employeeDepartments: Object
        },

        mounted() {

            if (this.employeeDepartments && this.employeeDepartments.data) {

                this.items = this.employeeDepartments.data;

                this.createPaginationProps(this.employeeDepartments);
            }
        },

        data() {

            return {
                items: null,
                fields: [
                    {
                        key: 'name',
                        label: this.trans('employees::employee_department.name'),
                        sortable: true
                    }, {
                        key: 'code',
                        label: this.trans('employees::employee_department.code'),
                        sortable: true
                    }
                ],
            }
        }
    }
</script>