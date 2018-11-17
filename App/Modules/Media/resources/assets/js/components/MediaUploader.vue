<template>
    <b-form-file v-model="file" plain :placeholder="trans('media::uploader.placeholder')"></b-form-file>
</template>

<script>
    export default {

        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.FormHelpers],

        data(){

            return {

                file: null
            }
        }
    }
</script>