<template>

    <b-form-group :label="label">
        <div class="media-uploader border rounded" @mouseover="showUploadIcon" @mouseleave="hideUploadIcon">

            <b-img-lazy :class="{'iconVisible':iconVisible}" v-if="imageUrl" class="image rounded" :src="imageUrl"></b-img-lazy>

            <b-form-file v-model="file" plain :title="trans('media::uploader.placeholder')"></b-form-file>

            <span v-if="!imageUrl || iconVisible" class="fa fa-fw fa-upload fa-3x"></span>

            <b-progress v-if="progress > 0" :value="progress" :max="max" show-progress animated></b-progress>
        </div>

    </b-form-group>
</template>

<script>
    export default {

        mixins: [C.mixins.Routes, C.mixins.Trans],

        props: {
            label: null,
            value: null,
            bucket: String
        },

        data(){

            return {

                imageUrl: null,
                progress: 0,
                max: 100,
                file: null,
                iconVisible: false,
            }
        },

        methods:{

            showUploadIcon(){

                this.iconVisible = true;
            },

            hideUploadIcon(){

                this.iconVisible = false;
            },

            uploadFile(file){

                const formData = new FormData();
                formData.append("file", file);
                formData.append("bucket", this.bucket);

                axios.post(this.route('media.upload'), formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: progressEvent => {
                        const totalLength = progressEvent.lengthComputable ? progressEvent.total : progressEvent.target.getResponseHeader('content-length') || progressEvent.target.getResponseHeader('x-decompressed-content-length');

                        if (totalLength !== null) {

                            this.progress = Math.round((progressEvent.loaded * 100) / totalLength);
                        }
                    }
                })
                .then(response => {

                    const image = new Image();

                    image.onload = () => {

                        this.imageUrl = response.data.data.media.small_url;
                        this.progress = 0;
                    };

                    image.src = response.data.data.media.small_url;

                    this.$emit('input', response.data.data.media.id);
                })
                .catch(this.handleSubmitResponse);
            }
        },

        watch: {

            file(newValue) {

                if(newValue){

                    this.uploadFile(newValue);
                }
            },

            value(newValue){

                this.imageUrl = `/media/${this.bucket}/${newValue}_small.jpeg`;
            }
        },
    }
</script>
