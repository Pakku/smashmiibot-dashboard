<template>
	<div>
		<h1>Login</h1>
		<form @submit.prevent="login">
			<label for="inputEmail">Email address</label>
			<input v-model="email" type="email" id="inputEmail" placeholder="Email address" required autofocus>
			<br/>
			<label for="inputPassword">Password</label>
			<input v-model="password" type="password" id="inputPassword" placeholder="Password" required>
			<br/>
			<button tytpe="submit">Sign in</button>
		</form>
	</div>
</template>

<script>
export default {
	name: 'Login',
	data () {
		return {
			email: '',
			password: ''
		}
	},
	mounted: function () {
		console.log('you are already logged');
		if (localStorage.getItem('accessToken')) {
			this.$router.push({ name: 'home'});
		}
	},
	methods: {
		login () {
			window.axios.post('/oauth/token', {
				'grant_type': 'password',
				'client_id': 2,
				'client_secret': '7afWXt9QaPTVNBiLDR5E04bn83G6MIcardsH28uj',
				'username': this.email,
				'password': this.password,
				'scope': '*',
			})
			.then((response) => {
				localStorage.setItem('accessToken', response.data.access_token);
				window.axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.access_token}`;
				this.$root.loadUser();
				this.$router.push({ name: 'home'});
			});
		}
	}
}
</script>