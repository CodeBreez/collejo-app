<template>

    <div>
        <dl class="row" v-for="entry in classes">
            <dd class="col-sm-3">

                <a v-if="can('view_batch_details')" :href="route('batch.details.view', entry.pivot.batch.id)">
                    {{ entry.pivot.batch.name }}
                </a>

                <span v-else>{{ entry.pivot.batch.name }}</span>

            </dd>
            <dd class="col-sm-3">{{ entry.pivot.class.grade.name }}</dd>
            <dd class="col-sm-3">{{ entry.pivot.class.name }}</dd>
            <dd class="col-sm-3">{{ dateFormat(dateToUserTz(entry.pivot.created_at)) }}</dd>
        </dl>
    </div>

</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.Permissions, C.mixins.DateTimeHelpers],

        props:{
            classes: Array,
            entity: Object
        },

    }
</script>