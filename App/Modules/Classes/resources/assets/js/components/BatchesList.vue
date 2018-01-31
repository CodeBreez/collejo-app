<template>
    <b-table :items="items" :fields="fields">

    </b-table>
</template>

<script>

    export default {
	    mixins: [ C.mixins.Routes, C.mixins.Trans ],
        data() {
	        return {
		        items: [
			        { isActive: true, age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
			        { isActive: false, age: 21, first_name: 'Larsen', last_name: 'Shaw' },
			        { isActive: false, age: 89, first_name: 'Geneva', last_name: 'Wilson' },
			        { isActive: true, age: 38, first_name: 'Jami', last_name: 'Carney' }
		        ],
		        fields: [
			        {
				        key: 'last_name',
				        sortable: true
			        },
			        {
				        key: 'first_name',
				        sortable: false
			        },
			        {
				        key: 'age',
				        label: 'Person age',
				        sortable: true,
				        // Variant applies to the whole column, including the header and footer
				        variant: 'danger'
			        }
		        ],
            }
        }
    }
</script>