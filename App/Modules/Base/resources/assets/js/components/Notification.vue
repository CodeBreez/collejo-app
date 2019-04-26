<template>
    <b-alert :variant="notification.variant" :show="notification.show" :dismissible="notification.dismissible"
             :dismiss-lable="notification.dismissLabel" @dismiss-count-down="countDownChanged">
        {{notification.message}}
        <ul v-if="notification.msgDetails">
            <li v-for="message in notification.msgDetails">{{message}}</li>
        </ul>
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