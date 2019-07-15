<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" @sort-changed="sortingChanged" responsive no-local-sorting>

            <template slot="name" slot-scope="row">
                <a :href="route('employee.details.view', row.item.id)">{{row.item.user.name}}</a>
            </template>

            <template slot="employee_department" slot-scope="row">
                <a :href="route('employee_department.details.edit', row.item.employee_department.id)">{{row.item.employee_department.name}}</a>
            </template>

            <template slot="employee_position" slot-scope="row">
                <a :href="route('employee_position.details.edit', row.item.employee_position.id)">{{row.item.employee_position.name}}</a>
            </template>

            <template slot="joined_on" slot-scope="row">
                {{dateFormat(dateToUserTz(row.value))}}
            </template>

        </b-table>

        <b-pagination-nav v-if="this.employees && this.employees.total > this.employees.per_page" align="center" :link-gen="linkGen" :base-url="baseUrl" :number-of-pages="totalPages" v-model="currentPage"></b-pagination-nav>

        <div class="placeholder-row" v-if="!items">
            <div class="placeholder">{{ trans('employees::employee.empty_list') }}</div>
        </div>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.PaginationHelper, C.mixins.TableHelper, C.mixins.DateTimeHelpers],

        props: {
            employees: Object
        },

        mounted() {

            if (this.employees && this.employees.data) {

                this.items = this.employees.data;

                this.createPaginationProps(this.employees);
            }
        },

        data() {

            return {
                items: null,
                fields: [
                    {
                        key: 'name',
                        label: this.trans('employees::employee.name'),
                        sortable: true
                    }, {
                        key: 'employee_number',
                        label: this.trans('employees::employee.employee_number'),
                        sortable: true
                    }, {
                        key: 'employee_department',
                        label: this.trans('employees::employee.employee_department'),
                        sortable: true
                    }, {
                        key: 'joined_on',
                        label: this.trans('employees::employee.joined_on'),
                        sortable: true
                    }, {
                        key: 'employee_position',
                        label: this.trans('employees::employee.employee_position'),
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