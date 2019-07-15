<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" @sort-changed="sortingChanged" responsive no-local-sorting>

            <template slot="name" slot-scope="row">
                <a :href="route('employee_position.details.edit', row.item.id)">{{row.item.name}}</a>
            </template>

            <template slot="employee_category" slot-scope="row">
                {{row.item.employee_category.name}}
            </template>

        </b-table>

        <b-pagination-nav v-if="this.employeePositions && this.employeePositions.total > this.employeePositions.per_page" align="center" :link-gen="linkGen" :base-url="baseUrl" :number-of-pages="totalPages" v-model="currentPage"></b-pagination-nav>

        <div class="placeholder-row" v-if="!items">
            <div class="placeholder">{{ trans('employees::employee_position.empty_list') }}</div>
        </div>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.PaginationHelper, C.mixins.TableHelper, C.mixins.DateTimeHelpers],

        props: {
            employeePositions: Object
        },

        mounted() {

            if (this.employeePositions && this.employeePositions.data) {

                this.items = this.employeePositions.data;

                this.createPaginationProps(this.employeePositions);
            }
        },

        data() {

            return {
                items: null,
                fields: [
                    {
                        key: 'name',
                        label: this.trans('employees::employee_position.name'),
                        sortable: true
                    }, {
                        key: 'employee_category',
                        label: this.trans('employees::employee_position.employee_category'),
                        sortable: true
                    }
                ],
            }
        }
    }
</script>