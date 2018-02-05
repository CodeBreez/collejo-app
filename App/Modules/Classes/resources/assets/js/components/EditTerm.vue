<template>
    <b-card bg-variant="light" :header="term.name">

        <p><span class="text-dark">Start Date :</span> {{term.start_date}}</p>
        <p><span>End Date : </span>{{term.end_date}}</p>

        <div slot="footer">
            <b-button variant="secondary" size="sm" @click="handleEdit">Edit</b-button>
            <b-button variant="outline-danger" size="sm" @click="handleDelete">Delete</b-button>
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
