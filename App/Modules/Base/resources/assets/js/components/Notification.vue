<template>
    <b-alert :variant="notification.variant" :show="notification.show" :dismissible="notification.dismissible"
             :dismiss-lable="notification.dismissLabel" @dismiss-count-down="countDownChanged">
        {{notification.message}}
        <!--br/>
        <b-progress v-if="notification.show > 1" variant="notification.variant"
                    :max="5"
                    :value="dismissCountDown"
                    height="4px">
        </b-progress-->
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