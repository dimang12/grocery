<template>
    <div class="container-fluid p-0">
        <navbar></navbar>
        <sub-navbar></sub-navbar>
        <router-view ></router-view>
    </div>
</template>
<script>
import VueRouter from 'vue-router';
import SubNavbar from "./SubNavbar";
import Home from "../Home";
export default {
    components: {SubNavbar, Home},
    router: new VueRouter({
        mode: 'history',
        base: '',
        routes: [
            // router for Home page
            {
                path: '/home/',
                name: 'home',
                component: Home
            },
            {
                path: '*',
                redirect: 'home'
            }

        ]
    })
}
</script>
