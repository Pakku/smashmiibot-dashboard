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
});

export default app;