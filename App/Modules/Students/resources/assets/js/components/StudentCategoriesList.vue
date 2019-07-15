<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" @sort-changed="sortingChanged" responsive no-local-sorting>

            <template slot="actions" slot-scope="row">
                <b-button v-b-tooltip variant="outline-secondary" :href="route('students.list')">
                    {{ trans('students::student_category.view_students') }}
                </b-button>
            </template>

        </b-table>

        <b-pagination-nav v-if="this.categories && this.categories.total > this.categories.per_page" align="center" :link-gen="linkGen" :base-url="baseUrl"
                          :number-of-pages="totalPages" v-model="currentPage"></b-pagination-nav>

        <div class="placeholder-row" v-if="!items">
            <div class="placeholder">{{ trans('students::student_category.empty_list') }}</div>
        </div>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.PaginationHelper, C.mixins.TableHelper, C.mixins.DateTimeHelpers],

        props: {
            categories: Object
        },

        mounted() {

            if (this.categories && this.categories.data) {

                this.items = this.categories.data;

                this.createPaginationProps(this.categories);
            }
        },

        data() {

            return {
                items: null,
                fields: [
                    {
                        key: 'name',
                        label: this.trans('students::student_category.name'),
                        sortable: true
                    }, {
                        key: 'code',
                        label: this.trans('students::student_category.code'),
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