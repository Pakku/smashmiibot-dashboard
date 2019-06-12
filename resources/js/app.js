require('./bootstrap');
import Vue from 'vue';

// Route information for Vue Router
import Routes from '@/js/routes.js';

// Component File
import App from '@/js/views/App';

const app = new Vue({
    el: '#app',
    router: Routes,
    render: h => h(App),
    data: {
    	user: undefined
    },
    methods: {
    	loadUser: function () {
    		if (!this.user) {
    			window.axios.get('/api/user')
					.then((response) => {
						this.user = response.data;
					})
					.catch((error) => {
						return undefined;
					});
    		}

    		return this.user;
    	}
    }
});

export default app;