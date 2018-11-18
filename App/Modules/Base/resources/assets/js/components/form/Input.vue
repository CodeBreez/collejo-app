<template>

    <b-form-group :label="label">

        <datepicker v-if="type === 'date'" input-class="form-control"
                    v-model="inputValue"
                    :format="getCalendarFormat()"
                    @input="_updateInput()">
        </datepicker>

        <b-form-select v-if="type === 'select'"
                       v-model="inputValue"
                       :name="name"
                       value-field="id"
                       text-field="name"
                       :options="options"
                       @input="_updateInput()"></b-form-select>

        <b-form-input v-if="type === 'text' || type === 'number'" :type="type"
                      v-model="inputValue"
                      :name="name"
                      :placeholder="placeholder"
                      @input="_updateInput()"></b-form-input>

        <div class="invalid-feedback"
             v-for="(rule, index) in _getFieldRules()"
             v-if="validator && validator['form'][name].$dirty && !validator['form'][name][rule]">
            {{ trans('base::validation.' + rule, label) }}
        </div>

    </b-form-group>
</template>

<script>

    import Datepicker from 'vuejs-datepicker';

    export default {
        components: {
            Datepicker
        },

        mixins: [C.mixins.DateTimeHelpers, C.mixins.Trans],

        props: {
            type: String,
            validator: null,
            name: null,
            label: null,
            placeholder: null,
            value: null,
            options: null,
        },

        data(){
            return {
                inputValue: null
            }
        },

        updated(){

            this._updateInputValue();
        },

        mounted(){

            this._updateInputValue();
        },

        methods: {

            _updateInputValue(){

                this.inputValue = this.value;
            },

            _getFieldRules(){

                if(this.validator){

                    return _.keys(this.validator.form[this.name]).filter(field => {

                        return field.charAt(0) !== '$';
                    });
                }

                return [];
            },

            _updateInput() {

                if(this.inputValue !== null || this.inputValue !== ''){

                    this.$emit('input', this.inputValue);
                }

                if(this.validator){

                    if(!this.validator.form[this.name]){

                        console.error(`field '[this.name]' is defined in the form`);
                        return
                    }

                    this.validator.form[this.name].$touch();
                }
            }
        }
    }
</script>