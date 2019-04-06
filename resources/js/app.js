require('./bootstrap');

/**
 * Get important stuff
 */

// Vue base
window.Vue = require('vue');

// Forms
import {
    Form,
    HasError,
    AlertError
} from 'vform'

window.Form = Form
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// Sweet Alert
import SweetAlert from 'sweetalert2'
window.SweetAlert = SweetAlert
window.Toast = SweetAlert.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000
});

// Vue Router
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Vue Events
import VueEvents from "vue-events";
Vue.use(VueEvents);
var Events = new Vue({});
window.Events = Events;

/**
 * Define routes and components
 */
let dashboardComponent = require('./components/Dashboard.vue').default
let settingsComponent = require('./components/Settings.vue').default
let postsComponent = require('./components/Posts.vue').default

const routes = [{
        path: '/admin',
        component: dashboardComponent
    },
    {
        path: '/dashboard',
        component: dashboardComponent
    },
    {
        path: '/settings',
        component: settingsComponent
    },
    {
        path: '/posts',
        component: postsComponent
    },
]

/**
 * Start router and app
 */
const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    router,
});
