<template>
	<b-form @submit.prevent="onSubmit" novalidate>

        <div class="row row-column-group">
            <div class="col-md-4" v-for="permission in rolePermissions" :key="permission.id">

                <ul class="list-unstyled">
                    <li>
                        <b-form-checkbox v-model="permission.checked">
                            {{permission.name}}
                        </b-form-checkbox>

                        <ul v-if="permission.children.length">

                            <li class="list-unstyled">

                                <b-form-checkbox @change="checkParent(permission)"
                                                 v-model="subPermission.checked"
                                                 v-for="subPermission in permission.children"
                                                 :key="subPermission.id">
                                    {{subPermission.name}}
                                </b-form-checkbox>

                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
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
			entity: {
				default: null,
				type: Object
			},
			permissions: {
				default: [],
				type: Array
			}
		},

		data(){
			return {
				action: this.entity ? this.route('role.edit', this.entity.id) : this.route('role.new'),
				rolePermissions: [],
				submitDisabled:false
			}
		},

		mounted(){

			this.rolePermissions = this.permissions.map(this._mapper);
		},

		methods:{

		    _mapper(permission){

                return {
                    id: permission.id,
                    name: permission.name,
                    checked: this.entity.permissions.map(p => {

                        return p.id;
                    }).indexOf(permission.id) >= 0,
                    children: permission.children ? permission.children.map(this._mapper) : null
                }
            },

            checkParent(permission){

                setTimeout(() => {
                    const checked = permission.children.filter(child => {

                        return child.checked;
                    });

                    permission.checked = checked.length > 0;
                }, 100)
            },

            _getCheckedIds(){

                let ids = [];

                this.rolePermissions.forEach(permission => {

                    if(permission.checked){

                        ids.push(permission.id);
                    }

                    if(permission.children){

                        permission.children.forEach(child => {

                            if(child.checked){

                                ids.push(child.id);
                            }
                        })
                    }

                });

                return ids;
            },

			onSubmit(){

				this.submitDisabled = true;

				axios.post(this.action, {
                    permissions: this._getCheckedIds()
				})
					.then(this.handleSubmitResponse)
					.catch(this.handleSubmitResponse);
			}
		}

	}
</script>