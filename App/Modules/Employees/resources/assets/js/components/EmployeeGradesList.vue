<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" @sort-changed="sortingChanged" responsive no-local-sorting>

            <template slot="name" slot-scope="row">
                <a :href="route('employee_grade.details.edit', row.item.id)">{{row.item.name}}</a>
            </template>

        </b-table>

        <b-pagination-nav v-if="this.employeeGrades && this.employeeGrades.total > this.employeeGrades.per_page" align="center" :link-gen="linkGen" :base-url="baseUrl" :number-of-pages="totalPages" v-model="currentPage"></b-pagination-nav>

        <div class="placeholder-row" v-if="!items">
            <div class="placeholder">{{ trans('employees::employee_grade.empty_list') }}</div>
        </div>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.PaginationHelper, C.mixins.TableHelper, C.mixins.DateTimeHelpers],

        props: {
            employeeGrades: Object
        },

        mounted() {

            if (this.employeeGrades && this.employeeGrades.data) {

                this.items = this.employeeGrades.data;

                this.createPaginationProps(this.employeeGrades);
            }
        },

        data() {

            return {
                items: null,
                fields: [
                    {
                        key: 'name',
                        label: this.trans('employees::employee_grade.name'),
                        sortable: true
                    }, {
                        key: 'code',
                        label: this.trans('employees::employee_grade.code'),
                        sortable: true
                    }, {
                        key: 'priority',
                        label: this.trans('employees::employee_grade.priority'),
                        sortable: true
                    }, {
                        key: 'max_sessions_per_day',
                        label: this.trans('employees::employee_grade.max_sessions_per_day'),
                        sortable: true
                    }, {
                        key: 'max_sessions_per_week',
                        label: this.trans('employees::employee_grade.max_sessions_per_week'),
                        sortable: true
                    },
                ],
            }
        }
    }
</script>