<template>
    <b-form @submit.prevent="onSubmit">

        <div class="col-md-6 multi-select-form">
            <b-form-checkbox v-model="role.checked" v-for="(role, index) in userRoles" :key="role.id">
                {{role.name}}
            </b-form-checkbox>
        </div>

        <div class="col-md-12">
            <b-button type="submit" :disabled="submitDisabled" variant="primary">{{ trans('base::common.save') }}</b-button>
        </div>

    </b-form>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.FormHelpers],

        props:{
            validation: Object,
            user: {
                default: null,
                type: Object
            },
            roles: {
                default: [],
                type: Array
            }
        },
        data(){

            return {
                action: this.route('user.roles.edit', this.user.id),
                userRoles: [],
                submitDisabled:false
            }
        },
        mounted(){

            this.userRoles = this.roles.map(role => {

                return {
                    name: role.name,
                    checked: this.user.roles.map(r => {

                        return r.id;
                    }).indexOf(role.id) >= 0,
                    id: role.id
                }
            });
        },
        methods:{

            onSubmit(){

                this.submitDisabled = true;

                axios.post(this.action, {
                    roles: this.userRoles.filter(role => {

                        return role.checked;
                    }).map(role => {

                        return role.id;
                    })
                })
                    .then(this.handleSubmitResponse)
                    .catch(this.handleSubmitResponse);
            }
        }
    }
</script>