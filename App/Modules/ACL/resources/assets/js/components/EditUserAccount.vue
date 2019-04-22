<template>
    <b-form @submit.prevent="onSubmit" novalidate>

       <div class="col-md-6">

           <c-form-input type="email"
                         v-model="form.email"
                         name="email"
                         :label="trans('acl::user.email')"
                         :validator="$v"></c-form-input>

           <c-form-input type="text"
                         v-model="form.password"
                         name="password"
                         :label="trans('acl::user.password')"
                         :validator="$v"></c-form-input>

       </div>

        <div class="col-md-12">
            <b-button type="submit" :disabled="submitDisabled" variant="primary">{{ trans('base::common.save') }}</b-button>
        </div>

    </b-form>
</template>

<script>

    export default {
        mixins: [C.mixins.Routes, C.mixins.Trans, C.mixins.FormHelpers],

        data(){

            return {
                action: this.route('user.account.edit', this.entity.id)
            }
        }

    }
</script>