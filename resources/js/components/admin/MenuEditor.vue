<template>
    <div class="block-01">
        <div class="bl-body p-3">
            <router-view :initialCategories="categories"></router-view>
        </div>
    </div>
</template>
<script>
    import VueRouter from 'vue-router';
    import CategoryManager from '../CategoryManager.vue';
    import MenuItem from '../MenuItem.vue';
    import ProductList from '../ProductList.vue';
    import NewProduct from '../products/NewProduct.vue';
    import ProductDetail from '../products/ProductDetail.vue'
    import EditProduct from "../products/EditProduct";
    import store from '../../store/index';

    // Vue.use(VueRouter);
    export default {
        store,
        props: ['categories'],
        created() {
            this.$store.commit('SET_CATEGORIES', _.cloneDeep(this.categories));
        },
        router: new VueRouter({
            mode: 'history',
            base: 'admin',
            routes: [
                {
                    path: '/categories/:id',
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
                    path: '/product-list/:id',
                    name: 'product-list',
                    component: ProductList

                },
                {
                    path: '/product-detail/:id',
                    name: 'product-detail',
                    component: ProductDetail
                },
                {
                    path: '/new-product',
                    name: 'new-product',
                    component: NewProduct
                },
                {
                    path:'/edit-product/:id',
                    name: 'edit-product',
                    component: EditProduct,
                    props: true
                },
                {
                    path: '*',
                    redirect: {name: 'categories'}
                },
            ]
        })
    }
</script>
