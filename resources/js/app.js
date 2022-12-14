/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueRouter from 'vue-router';
import VModal from 'vue-js-modal';
import HeaderComponent from "./components/HeaderComponent";
import LoginComponent from "./components/LoginComponent";
import HomeComponent from "./components/HomeComponent";
import CeoComponent from "./components/CeoComponent";
import CreateComponent from "./components/CreateComponent";
import LoadingComponent from "./components/LoadingComponent";
import NotificationComponent from "./components/NotificationComponent";

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('header-component', HeaderComponent);
Vue.component('login-component', LoginComponent);
Vue.component('home-component', HomeComponent);
Vue.component('ceo-component', CeoComponent);
Vue.component('loading-component', LoadingComponent);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.use(VueRouter);
 Vue.use(VModal);
 
 const router = new VueRouter({
     mode: 'history',
     routes: [
         {
             path: '/login',
             name: 'login',
             component: LoginComponent,
         },
         {
            path: '/home',
            name: 'home',
            component: HomeComponent,
        },
        {
            path: '/post',
            name: 'post',
            component: CreateComponent,
        },
        {
            path: '/ceo',
            name: 'ceo',
            component: CeoComponent,
        },
        {
            path: '/loading',
            name: 'loading',
            component: LoadingComponent,
        },
        {
            path: '/notification',
            name: 'notification',
            component: NotificationComponent,
        },
     ]
 });

new Vue({
    el: '#app',
    router,
});