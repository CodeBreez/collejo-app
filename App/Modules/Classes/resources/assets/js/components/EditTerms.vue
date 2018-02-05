<template>
    <b-card bg-variant="light" :header="term.name" class="text-center">
        <p class="card-text">Start Date {{term.start_date}}</p>
        <p class="card-text">End Date {{term.end_date}}</p>

        <b-button variant="link" @click="handleDelete">Delete</b-button>
        <b-button variant="link" @click="handleEdit">Edit</b-button>
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
