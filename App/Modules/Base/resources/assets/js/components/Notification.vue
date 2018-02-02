<template>
    <b-alert :variant="notification.variant" :show="notification.show" :dismissible="notification.dismissible"
             :dismiss-lable="notification.dismissLabel">
        {{notification.message}}
    </b-alert>
</template>

<script>

    export default {
        props: {
            notification: {
                default: {},
                type: Object
            }
        }
    }
</script>