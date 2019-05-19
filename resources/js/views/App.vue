<template>
	<v-app>
		<v-navigation-drawer app></v-navigation-drawer>
		<v-toolbar app></v-toolbar>
		<v-content>
			<v-container fluid>
				<router-link tag="li" to="/">Home</router-link>
				<router-link tag="li" to="/about">About</router-link>
				<router-view></router-view>
			</v-container>
		</v-content>
		<v-footer app></v-footer>
	</v-app>
</template>
<script>
	export default {
		data: function () {
			return {
				user: undefined,
			}
		},
		mounted: function () {
			if (!this.user) {
				this.$router.push({ name: 'login'});
			} else {
				console.log(this.user);
			}
		},
		watch: {
			$route (to, from) {
				if (to.name!='login' && !this.user) {
					console.log('you have to login');
					this.$router.push({ name: 'login'});
				}
			}
		}
	};
</script>