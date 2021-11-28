/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import {BootstrapVue, IconsPlugin} from 'bootstrap-vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('category-manager', require('./components/CategoryManager.vue').default);
Vue.component('menu-item', require('./components/MenuItem.vue').default);

Vue.component('admin-menu-editor', require('./components/admin/MenuEditor.vue').default);
Vue.component('admin-product-list', require('./components/admin/AdminProductList.vue').default);

// Control on product
Vue.component('produt-manager', require('./components/products/ProductManager').default)
Vue.component('product-list', require('./components/ProductList.vue').default);
//Layout
Vue.component('front-layout', require('./components/frontend/layout/Layout').default);
Vue.component('navbar', require('./components/frontend/layout/Navbar').default);

// add BoostrapVue into project
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
