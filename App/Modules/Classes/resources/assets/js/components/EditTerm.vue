<template>
    <b-card bg-variant="light" :header="term.name">

        <p><span class="text-dark">{{trans('classes::term.start_date')}} :</span> {{term.start_date}}</p>
        <p><span>{{trans('classes::term.end_date')}} : </span>{{term.end_date}}</p>

        <div slot="footer">
            <b-button variant="secondary" size="sm" @click="handleEdit">{{trans('base::common.edit')}}</b-button>
            <b-button variant="outline-danger" size="sm" @click="handleDelete">{{trans('base::common.delete')}}
            </b-button>
        </div>
    </b-card>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans],
        props: {
            term: {
                default: () => {
                },
                type: Object
            }
        },
        methods: {
            handleDelete() {

                this.$emit('delete');
            },
            handleEdit() {

                this.$emit('edit');
            }
        }
    }
</script>
