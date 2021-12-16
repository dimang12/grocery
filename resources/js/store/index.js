import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        categories: [],
        products: [],
        category: {}
    },
    mutations: {
        SET_CATEGORIES(state, categories) {
            state.categories = categories
        },
        ADD_CATEGORY(state, category) {
            state.categories.push(category);
        },
        REMOVE_CATEGORY(state, index) {
            state.categories.slice(index, 1);
        },

        SET_PRODUCTS(state, products){
            state.products = products;
        },
        // current category
        SET_CATEGORY(state, category) {
            state.category = category
        }
    }
});
