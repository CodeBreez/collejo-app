<template>
    <b-card bg-variant="light" :header="clasis.name">

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
            clasis: {
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
