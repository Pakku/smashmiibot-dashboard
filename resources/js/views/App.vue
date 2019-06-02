<template>
	<div>
		<router-link tag="li" to="/">Home</router-link>
		<router-link tag="li" to="/about">About</router-link>
		<router-view></router-view>
	</div>
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
				if (localStorage.getItem('accessToken')) {
					window.axios.get('/api/user')
						.then((response) => {
							console.log(response);
						})
						.catch((error) => {
							console.log(error);
							this.$router.push({ name: 'login'});
						});
				} else {
					this.$router.push({ name: 'login'});
				}
				
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