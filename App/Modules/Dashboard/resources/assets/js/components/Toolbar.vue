<template>
    <div>
        <div class="float-right">

            <slot name="tools"></slot>
            <b-button v-if="filters" v-b-toggle.criteriaPanel variant="secondary-outline"
                      :pressed="criteriaPanelVisible" v-b-tooltip
                      :title="trans('base::common.search_filter')">
                <i class="fa fa-filter"></i>
            </b-button>
        </div>

        <slot name="title"></slot>

        <b-collapse id="criteriaPanel" v-on:hidden="savePanelState" v-on:shown="savePanelState" v-model="criteriaPanelVisible" class="criteria-panel">

            <b-card>
                <b-form inline class="justify-content-between">
                    <div class="float-left">

                        <span v-for="inp in filters" class="input-group">

                            <label class="filter-input-label" v-if="inp.type === 'text'">
                                <span>{{inp.label}}</span>
                                <b-form-input size="sm"
                                              v-model="inp.value"
                                              :key="inp.name"
                                              type="text"
                                              :name="inp.name"
                                              :placeholder="inp.label">
                                </b-form-input>
                            </label>

                            <label class="filter-input-label" v-if="inp.type === 'select'">
                                <span>{{inp.label}}</span>
                                <b-form-select size="sm"
                                               v-model="inp.value"
                                               :key="inp.name"
                                               :options="inp.items"
                                               :name="inp.name"
                                               :placeholder="inp.label">
                                </b-form-select>
                            </label>

                        </span>

                    </div>

                    <div class="float-right">

                        <span v-if="sorting && sorting.sortBy">

                            <input type="hidden" name="sort" :value="sorting.sortBy"/>
                            <input type="hidden" v-if="sorting.sortDesc" name="order" value="desc"/>
                            <input type="hidden" v-if="!sorting.sortDesc" name="order" value="asc"/>

                            <label class="filter-title text-muted">{{trans('base::common.sorting_by')}}</label>
                            <b-button variant="link" disabled>
                                <i v-bind:class="{'fa-sort-amount-up' : sorting.sortDesc , 'fa-sort-amount-down' : !sorting.sortDesc}" class="fa"></i> {{sorting.sortByLabel}}</b-button>
                        </span>

                        <b-button type="submit" variant="secondary">{{trans('dashboard::dash.filter_results')}}</b-button>
                        <b-button variant="outline-secondary" :href="basePath">{{trans('dashboard::dash.reset_filters')}}</b-button>
                    </div>
                </b-form>
            </b-card>
        </b-collapse>
    </div>
</template>

<script>

    import store from 'store2';

    export default  {
        mixins: [ C.mixins.Routes, C.mixins.Trans],

        data(){

            return {
                sorting: null,
                basePath: `${location.protocol}//${location.host}${location.pathname}`,
                criteriaPanelVisible: Boolean(store.has('criteria_panel_visible') && store('criteria_panel_visible') && this.filters)
            }
        },

        props: {
            filters: {
                type: Array,
                default: null
            }
        },

        mounted(){

            setInterval(() => {

                this.sorting = window.C.sorting;
            }, 500);
        },

        methods: {

            savePanelState(){

                store('criteria_panel_visible', this.criteriaPanelVisible);
            }
        }
    }

</script>