<template>

    <b-form-group :label="label" :label-for="id">

        <b-form-input :id="id" :type="type"
                      v-model="value"
                      @input="update()"></b-form-input>

        <div class="invalid-feedback"
             v-for="(rule, index) in _getFieldRules()"
             v-if="validator && validator['form'][name].$dirty && !validator['form'][name][rule]">
            {{ trans('base::validation.' + rule, label) }}
        </div>

    </b-form-group>
</template>

<script>

    export default {
        mixins: [C.mixins.Trans],
        props: {
            model: null,
            type: String,
            id: String,
            validator: null,
            name: null,
            label: null
        },
        data(){
            return {
                value: null
            }
        },

        methods: {

            _getFieldRules(){

                if(this.validator){

                    return _.keys(this.validator['form'][this.name]).filter(field => {

                        return field.charAt(0) !== '$';
                    });
                }

                return [];
            },

            update() {
                this.$emit('input', this.value);
                if(this.validator){

                    this.validator['form'][this.name].$touch();
                }
            }
        }
    }
</script>