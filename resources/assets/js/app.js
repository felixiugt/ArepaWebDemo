
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import router from './routes';
import App from './components/App.vue';

Vue.use(VueRouter);
Vue.use(Vuex);
const routes = new VueRouter({
    routes,
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 import VueGoodTablePlugin from 'vue-good-table';

 // import the styles
 import 'vue-good-table/dist/vue-good-table.css'
 import VModal from 'vue-js-modal'
 import { ValidationProvider } from 'vee-validate';
 import VueSimpleAlert from "vue-simple-alert";

 Vue.use(VueSimpleAlert);
// Register it globally
// main.js or any entry file.

Vue.component('ValidationProvider', ValidationProvider);
 Vue.use(VModal)

 Vue.use(VueGoodTablePlugin);

const app = new Vue({
    el: '#app',
    router,
    components: {
        App,
    },
    mode: 'history',
});
