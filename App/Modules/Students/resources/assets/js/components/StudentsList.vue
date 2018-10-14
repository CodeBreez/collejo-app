<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" @sort-changed="sortingChanged" responsive no-local-sorting>

            <template slot="name" slot-scope="row">
                <a :href="route('student.details.view', row.item.id)">{{row.item.user.name}}</a>
            </template>

            <template slot="clasis" slot-scope="row">
                {{row.item.class ? row.item.class.name : ''}}
            </template>

            <template slot="admitted_on" slot-scope="row">
                {{dateFormat(dateToUserTz(row.value))}}
            </template>

        </b-table>

        <b-pagination-nav v-if="this.students && this.students.total > this.students.per_page" align="center" :link-gen="linkGen" :base-url="baseUrl"
                          :number-of-pages="totalPages" v-model="currentPage"></b-pagination-nav>

        <div class="placeholder-row" v-if="!items">
            <div class="placeholder">{{ trans('students::student.empty_list') }}</div>
        </div>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.PaginationHelper, C.mixins.TableHelper, C.mixins.DateTimeHelpers],

        props: {
            students: Object
        },

        mounted() {

            console.log(this.students);

            if (this.students && this.students.data) {

                this.items = this.students.data;

                this.createPaginationProps(this.students);
            }
        },

        data() {

            return {
                items: null,
                fields: [
                    {
                        key: 'name',
                        label: this.trans('students::student.name'),
                        sortable: true
                    }, {
                        key: 'admission_number',
                        label: this.trans('students::student.admission_number'),
                        sortable: true
                    }, {
                        key: 'clasis',
                        label: this.trans('students::student.class'),
                        sortable: true
                    }, {
                        key: 'admitted_on',
                        label: this.trans('students::student.admitted_on'),
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