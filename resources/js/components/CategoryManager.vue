<template>
    <div class="block-01">
        <section class="row bl-header pb-3 mb-3">
            <h3 class="col-6">Category Manager</h3>
            <div class="col-6 action text-right">
                <button type="button" @click="addCategory()" class="btn btn-outline-secondary">
                    <i class="bi bi bi-file-plus-fill"></i>
                    Add category
                </button>
            </div>
        </section>
        <section class="row bl-body">
            <div class="col-md-8 col-sm-12 mb-3">
                <b-dropdown
                    :key="'cat-key-' + category.id"
                    size="large"
                    toggle-class="p-3"
                    v-for="(category, index) in categories"
                    :text="category.category_name"
                    variant="outline-secondary"
                    class="m-2"
                >
                    <b-dropdown-item :to="{name:'product-list', params:{id:category.id}}">List Products</b-dropdown-item>
                    <b-dropdown-item v-b-toggle.form-edit @click="setCategory(category.id)">Edit</b-dropdown-item>
                </b-dropdown>
            </div>
            <div class="col-md-4 col-sm-12">
                <form class="block-02 p-3" @submit.prevent="" >
                    <section class="bl-header pb-2 mb-2 d-flex">
                        <h4 class="flex-grow-0">New Category</h4>
                        <div class="action flex-grow-1">
                            <b-button-close></b-button-close>
                        </div>
                    </section>
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
                                <input required type="text" v-model="category.category_name" class="form-control">
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
                        <b-button class="btn btn-secondary" @click="saveCategories">
                            <i class="bi-save-fill"></i>
                            <span class="ml-2">Save</span>
                        </b-button>
                    </section>
                </form>
            </div>

            <b-sidebar id="form-edit" v-model="isShowSidebar"  ref="mySidebar" title="Edit Category"  shadow right backdrop>
                <div class="px-3 py-2">
                    <component :is="newOrEditCategory"></component>
                </div>
            </b-sidebar>


        </section>
    </div>
</template>
<script>
    import NewCategory from "./admin/NewCategory.vue";
    import EditCategory from "./admin/EditCategory";

    import store from "../store/index";
    export default {
        store,
        components: {EditCategory, NewCategory},
        props: [
            'initialCategories',

        ],
        data(){
            return{
                // categories: _.cloneDeep(this.initialCategories),
                category: {},
                addOrEdit: 2,
                addOrEditTittle: 'Edit Category',
                feedback: '',
                isShowSidebar: false
            };
        },
        computed: {
          categories() {
              return this.$store.state.categories;
            },
            newOrEditCategory() {
                return (this.addOrEdit == 1)? 'NewCategory': 'EditCategory';
            }
        },
        created() {
            // this.$refs.;
            // axios.post('/api/categories/upsert');
            this.category = {
                parent_id: 0,
                category_name: '',
                cate_detail: '',
                cate_ordering: this.categories.length + 1
            }
        },
        methods: {
            removeCategory(index) {
                if(confirm('Are you sure want to delete?')){
                    // this.categories.splice(index)
                    let id = this.categories[index].id;

                    axios
                        .delete('/api/categories/' + id)
                        .then(
                            (res) => {
                                this.categories.splice(index, 1)
                            }
                    );
                }
            },
            update(id) {
                if(confirm('Are you sure want to update?')){
                    alert(id);
                }else{

                }

            },
            addCategory() {
                this.isShowSidebar = true;
                this.addOrEdit = 1;
                // this.categories.push({
                //     category_name: '',
                //     parent_id: 0,
                //     left: 0,
                //     right: 0,
                //     cate_ordering: this.categories.length + 1
                // });
                // this.$nextTick(() => {
                //     window.scrollTo(0, document.body.scrollHeight);
                //     this.$refs[''][0].focus();
                //     console.log(this.$refs[''][0]);
                // });
                return false;
            },
            saveCategories() {
                // console.log(this.categories);
                // return false;
                axios
                    .post('/api/categories/upsert', {
                        // categories: this.categories,
                        categories: [this.category],
                    })
                    .then((res) => {
                        if (res.data.success) {
                            this.feedback = 'Changes saved.';
                            this.categories = res.data.categories;
                        }
                    })
                ;
            },

            setCategory(id) {
                let curCategory = {};
                this.addOrEdit = 2;
                this.categories.map((cate, index) => {
                    if (cate.id === id) {
                        curCategory = cate;
                    }
                });
                this.$store.commit('SET_CATEGORY', curCategory);
            },

            // Switch to show add or edit form
            toggleAddEdit(addOrEditOption = 1) {
                this.addOrEdit = addOrEditOption;

            }
        }
    }
</script>
