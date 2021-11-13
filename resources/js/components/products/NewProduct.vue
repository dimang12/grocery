<template>
    <main class="block-01">
        <h3 class="bl-header pt-3 pb-3 mb-4">
            <div class="row">
                <div class="col-8">New Product</div>
                <div class="col-4 action text-right">
                    <button type="button" class="btn btn-secondary" @click="save()">
                        <i class="bi-save-fill"></i>
                        <span>Saves</span>
                    </button>
                    <button class="btn btn-light text-dark" @click="$router.go(-1)">
                        <i class="bi-arrow-left-circle-fill"></i>
                        <span>Back</span>
                    </button>
                </div>
            </div>
        </h3>
        <div class="bl-body">
            <form class="block-02" @submit.prevent="save">
                <h5 class="bl-header p-3">Basic Information</h5>
                <div class="bl-body p-3">
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Category</label>
                            <select v-model="product.category_id" v-if="categories" class="form-control">
                                <option v-for="category in categories" v-bind:value="category.id">{{category.category_name}}</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Product Name</label>
                            <input @change="generateSlug" v-model="product.product_name" type="text" placeholder="type product name here" class="form-control"  name="product_name"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label class="form-label">SKU</label>
                            <input v-model="product.SKU" type="text" name="price" class="form-control" placeholder="price can be number or decimal"/>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Price</label>
                            <input v-model="product.price" type="text" name="price" class="form-control" placeholder="price can be number or decimal"/>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Size</label>
                            <input v-model="product.size" type="text" placeholder="size can be text or number" class="form-control"  name="size"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label class="form-label">Availability</label>
                            <b-form-select v-model="product.available">
                                <b-select-option value="1">Year round product</b-select-option>
                                <b-form-select-option value="2">Seasonal product</b-form-select-option>
                                <b-form-select-option value="3">Holiday product</b-form-select-option>
                            </b-form-select>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Origin</label>
                            <input v-model="product.origin" type="text" placeholder="USA..." class="form-control"  name="size"/>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Available at</label>
                            <input class="form-control" type="date" v-model="product.available_at" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Profile</label>
                            <textarea rows="5" v-model="product.profile" class="form-control" name="profile"></textarea>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Details</label>
                            <textarea rows="5" v-model="product.details" class="form-control" name="details"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div>
                                <label for="formFileLg" class="form-label">Large file input example</label>
                                <input class="form-control" id="formFileLg" type="file">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div>
                                <label class="form-label">Our story</label>
                                <b-textarea rows="8" v-model="product.our_story"></b-textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="bl-footer pt-3 mt-4">
            <div class="col-12 action text-right">
                <button type="button" class="btn btn-secondary" @click="save()">
                    <i class="bi-save-fill"></i>
                    <span>Saves</span>
                </button>
                <button class="btn btn-light text-dark" @click="$router.go(-1)">
                    <i class="bi-arrow-left-circle-fill"></i>
                    <span>Back</span>
                </button>
            </div>
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
            categories: _.cloneDeep(this.initCategories),
            product: {
                product_name: '',
                slug: '',
                SKU: '',
                category_id: '',
                price: 0,
                size: '',
                profile: '',
                details: '',
                our_story: '',
                available: 1,
                origin: '',
                available_at: ''
            }
        }
    },
    created() {
        axios.get('/api/categories/')
            .then((res) => {
                this.categories = res.data;
            })
        ;
    },
    methods: {

        save() {
            axios
                .post('/api/product/add', this.product)
                .then((res) => {
                    this.$router.push({path: '/product-list'});
                })
                .catch((error) => {

                })
            ;
        },
        generateSlug() {
            this.product.slug = this.product.product_name.trim().replace(/\s/g, '-');
        }
    }
}
</script>
