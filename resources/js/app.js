require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import App from './components/App.vue';
Vue.use(VueRouter)

const routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default},
    { path: '/profile', component: require('./components/Profile.vue').default},
]

const router = new VueRouter({
    routes
})

const app = new Vue({
    el: '#app',
    router,
});
