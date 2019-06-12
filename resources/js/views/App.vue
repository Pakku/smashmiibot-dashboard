<template>
	<div>
		<router-link tag="li" to="/">Home</router-link>
		<router-link tag="li" to="/about">About</router-link>
		<li v-if="$root.$data.user">Logout</li>
		<router-view></router-view>
	</div>
</template>
<script>
	export default {
		data: function () {
			return {
			}
		},
		mounted: function () {
			if (localStorage.getItem('accessToken')) {
				this.$root.loadUser();
			} else {
				this.$router.push({ name: 'login'});
			}
		},
		watch: {
			$route (to, from) {
				if (to.name!='login' && !localStorage.getItem('accessToken')) {
					console.log('you have to login');
					this.$router.push({ name: 'login'});
				}
			}
		}
	};
</script>