<template>
	<b-navbar toggleable="sm" type="light" variant="light">

		<b-nav-toggle target="nav_collapse"></b-nav-toggle>

		<b-navbar-brand href="/"> Collejo</b-navbar-brand>

		<b-collapse is-nav id="nav_collapse">

			<b-navbar-nav>

                <b-nav-item-dropdown v-for="menu in menus" :key="menu.name" v-if="menu.position == 'left'"
                                     :text="'<i class=\'fa '+menu.icon+'\'></i>' + menu.label" left>

				<b-dropdown-item v-for="subMenu in menu.children" :key="subMenu.name" :href="subMenu.path">{{ subMenu.label }}</b-dropdown-item>

			</b-nav-item-dropdown>

			</b-navbar-nav>

			<b-navbar-nav class="ml-auto">

                <b-nav-form class="hyper-search-form">

					<b-form-input size="sm" class="mr-sm-2" type="text" placeholder="Search"/>

				</b-nav-form>

				<span v-for="menu in menus" :key="menu.name">

					<b-nav-item-dropdown v-if="menu.position == 'right'"
                                         :text="'<i class=\'fa '+menu.icon+'\'></i>' + menu.label" right>
						<b-dropdown-item :href="subMenu.path" v-for="subMenu in menu.children" :key="subMenu.name">{{ subMenu.label }}</b-dropdown-item>
					</b-nav-item-dropdown>

				</span>

			</b-navbar-nav>

		</b-collapse>
	</b-navbar>
</template>

<script>

	export default  {
		mixins: [ C.mixins.Routes, C.mixins.Trans],
		created(){

			this.menus = window.C.menus;
		}
	}

</script>