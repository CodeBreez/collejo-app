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
                       <label class="filter-title text-muted">{{trans('dashboard::dash.filter_by')}}</label>
                       <b-form-input v-for="inp in filters"
                                     v-if="inp.type === 'text'"
                                     v-model="inp.value"
                                     :key="inp.name"
                                     type="text"
                                     :name="inp.name"
                                     :placeholder="inp.label">
                       </b-form-input>
                    </div>
                    <div class="float-right">
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
        methods: {
            savePanelState(){
                store('criteria_panel_visible', this.criteriaPanelVisible);
            }
        }
    }

</script>