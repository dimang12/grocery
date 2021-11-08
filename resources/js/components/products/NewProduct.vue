<template>
    <main class="block-01">
        <h3 class="bl-header pt-3 pb-3 mb-4">
            <div class="row">
                <div class="col-8">New Product</div>
                <div class="col-4 action text-right">
                    <button type="button" class="btn btn-light text-dark" >
                        <i class="bi-save-fill"></i>
                        <span>Save</span>
                    </button>
                    <button class="btn btn-light text-dark" @click="$router.go(-1)">
                        <i class="bi-arrow-left-circle-fill"></i>
                        <span>Back</span>
                    </button>
                </div>
            </div>
        </h3>
        <div class="bl-body">
            <form class="block-02">
                <h5 class="bl-header p-3">Basic Information</h5>
                <div class="bl-body p-3">
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Category</label>
                            <select v-if="categories" class="form-control">
                                <option v-for="category in categories">{{category.category_name}}</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" placeholder="type product name here" class="form-control"  name="product_name"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Price</label>
                            <input type="text" name="price" class="form-control" placeholder="price can be number or decimal"/>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Size</label>
                            <input type="text" placeholder="size can be text or number" class="form-control"  name="size"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Profile</label>
                            <textarea class="form-control" name="profile"></textarea>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Size</label>
                            <textarea  class="form-control" name="details"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div>
                                <label for="formFileLg" class="form-label">Large file input example</label>
                                <input class="form-control" id="formFileLg" type="file">
                            </div>
                        </div>
                        <div class="col-6">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</template>
<script>
export default {
    props: {
        initCategories: Array
    },
    data() {
        return{
            categories: _.cloneDeep(this.initCategories)
        }
    },
    created() {
        axios.get('/api/categories/')
            .then((res) => {
                this.categories = res.data;
            })
        ;
    }
}
</script>
