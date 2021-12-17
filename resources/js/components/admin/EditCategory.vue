<template>
    <div class="">
        <form class="p-3" @submit.prevent="" >
            <section class="bl-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label">Parent</label>
                        <select v-model="category.parent_id" class="form-control ">
                            <option v-bind:value="0">Root category</option>
                            <option v-for="(cate, index) in categories" v-bind:value="cate.id">{{cate.category_name}}</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Category name</label>
                        <input type="text" v-model="category.category_name" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Category detail:</label>
                        <input type="text" v-model="category.cate_detail" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Ordering</label>
                        <input type="number" v-model="category.cate_ordering" class="form-control">
                    </div>
                </div>
            </section>
            <section class="bl-footer text-right pt-3 mt-2">
                <b-button class="btn btn-secondary" @click="updateCategory">
                    <i class="bi-save-fill"></i>
                    <span class="ml-2" >Update</span>
                </b-button>
            </section>
        </form>
    </div>
</template>
<script>
import store from '../../store/index';
export default {
    store,
    data() {
        return{
            // categories: _.cloneDeep(this.initialCategories),
            // category: this.$store.state.category,
            feedback: '',
        };
    },
    computed: {
        categories() {
            return this.$store.state.categories;
        },
        category() {
            return this.$store.state.category;
        }
    },
    methods: {
        updateCategory() {
            axios.put('api/categories/update/' + this.category.id, {
                category: this.category
            }).then(response => {
                console.log(response);
            })
            console.log(this.category.category_name)
        }
    }



}
</script>
