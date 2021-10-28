<template>
    <form class="row" @submit.prevent="saveCategories">
        <div class="col-12"> 
            <button type="button" @click="addCategory()" class="btn btn-light">
                <i class="bi bi bi-file-plus-fill"></i>
                Add category
            </button>
        </div>
        <div class="col-12"  v-for="(category,index) in categories" :key="category.id">
            <input type="text" v-model="category.category_name" :ref="category.category_name" />
            <input type="number" v-model="category.cate_ordering" />
            <a @click="update(category.id)" class="btn btn-primary">Update</a>
            <a @click="removeCategory(index)" class="btn btn-danger">Delete</a>

        </div>
        <button type="submit">Save</button>
        <div>{{ feedback }}</div>
    </form>
</template>
<script>
    export default {
        props: [
            'initialCategories',
        ],
        data(){
            return{
                categories: _.cloneDeep(this.initialCategories),
                feedback: '',
            };
        },
        // created() {
        //     axios.post('/api/categories/upsert');
        // },
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
                this.categories.push({
                    category_name: '',
                    parent_id: 0,
                    left: 0,
                    right: 0,
                    cate_ordering: this.categories.length + 1
                });
                this.$nextTick(() => {
                    window.scrollTo(0, document.body.scrollHeight);
                    this.$refs[''][0].focus();
                    console.log(this.$refs[''][0]);
                });
                return false;
            },
            saveCategories() {
                // console.log(this.categories);
                // return false;
                axios
                    .post('/api/categories/upsert', {
                        categories: this.categories,
                    })
                    .then((res) => {
                        if (res.data.success) {
                            this.feedback = 'Changes saved.';
                            this.categories = res.data.categories;
                        }
                    })
                ;
            }
        }
        
    }
</script>