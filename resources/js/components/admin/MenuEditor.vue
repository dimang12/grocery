<template>
    <div class="block-01">
        <h3 class="bl-header pb-3">Menu editor::</h3>
        <div class="bl-body p-3">
            <router-link :to="{name: 'categories'}" >Categories</router-link>
            <router-link :to="{name: 'add-item'}" >Add Item</router-link>
            <router-view :initialCategories="categories"></router-view>

        </div>
    </div>
</template>
<script>
    import VueRouter from 'vue-router';
    import CategoryManager from '../CategoryManager.vue';
    import MenuItem from '../MenuItem.vue';
    import ProductList from '../ProductList.vue';
    // Vue.use(VueRouter);
    export default {
        props: ['categories'],
        router: new VueRouter({
            mode: 'history',
            base: 'menu-editor', 
            routes: [
                {
                    path: '/categories',
                    name: 'categories', 
                    component: CategoryManager,
                },
                {
                    path: '/',
                    redirect: {name: 'categories'}
                },
                {
                    path: '/add-item',
                    name: 'add-item',
                    component: MenuItem
                },
                {
                    path: '/product-list',
                    name: 'product-list',
                    component: ProductList

                },
                {
                    path: '*',
                    redirect: {name: 'categories'}
                }


            ]
        })
    }
</script>