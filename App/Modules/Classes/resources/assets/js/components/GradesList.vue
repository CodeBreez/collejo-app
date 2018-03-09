<template>
    <div>
        <b-table v-if="items" :items="items" :fields="fields" responsive no-local-sorting>

            <template slot="name" slot-scope="row">
                <b-button variant="link" :href="route('grade.details.view', row.item.id)">{{row.value}}</b-button>
            </template>

            <template slot="classes" slot-scope="row">
                <b-button v-for="clasis in row.value" :key="clasis.id"
                          variant="outline-secondary" class="table-btn"
                          :href="route('grade.class.details.view', {id:row.item.id, cid:clasis.id})">{{clasis.name}}</b-button>
            </template>
        </b-table>

        <div class="placeholder-row" v-if="!items">
            <div class="placeholder">{{ trans('classes::grade.empty_list') }}</div>
        </div>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans],
        props: {
            grades: Object
        },
        mounted() {
            if (this.grades && this.grades.data) {
                this.items = this.grades.data;
            }
        },
        data() {
            return {
                items: null,
                fields: [
                    {
                        key: 'name',
                    }, {
                        key: 'classes'
                    }
                ],
            }
        }
    }
</script>