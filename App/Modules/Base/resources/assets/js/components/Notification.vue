<template>
    <b-alert :variant="notification.variant" :show="notification.show" :dismissible="notification.dismissible"
             :dismiss-lable="notification.dismissLabel" @dismiss-count-down="countDownChanged">
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
        },
        data() {
            return {
                dismissCountDown: 6
            }
        },
        methods: {
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            }
        }
    }
</script>