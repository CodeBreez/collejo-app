<template>

    <b-form-group :label="label">

        <b-form-input :type="type"
                      v-model="inputValue"
                      :name="name"
                      :placeholder="placeholder"
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
            type: String,
            validator: null,
            name: null,
            label: null,
            placeholder: null,
            value: null,
            model:null
        },

        data(){
            return {
                inputValue: null
            }
        },
        updated(){

            this.inputValue = this.value;
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
                this.$emit('input', this.inputValue);

                if(this.validator){

                    this.validator['form'][this.name].$touch();
                }
            }
        }
    }
</script>