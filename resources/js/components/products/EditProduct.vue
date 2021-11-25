<template>
    <main v-if="product" class="block-01">
        <section class="bl-header d-flex pt-3 pb-3 mb-3">
            <h3 class="flex-grow-0">{{product.product_name}}</h3>
            <div class="flex-grow-1 text-right">
                <button class="btn btn-secondary"
                        @click="update"
                >
                    Update
                </button>
                <button class="btn btn-light text-dark" @click="$router.go(-1)">
                    <i class="bi-arrow-left-circle-fill"></i>
                    <span>Back</span>
                </button>
            </div>
        </section>
        <section class="bl-body">
            <form class="block-02" @submit.prevent="update" method="post">
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
                            <label class="form-label">Product name <span v-if="errors.product_name !== undefined" class="text-danger">:{{ errors.product_name[0] }}</span></label>
                            <input @change="generateSlug" v-model="product.product_name"
                                   type="text" placeholder="type product name here"
                                   class="form-control"  name="product_name"
                                   v-bind:class="{'border-danger': errors.product_name !== undefined}"
                            />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label class="form-label">SKU <span v-if="errors.SKU !== undefined" class="text-danger">:{{ errors.SKU }}</span></label>
                            <input v-model="product.SKU" type="text" name="price" class="form-control" v-bind:class="{'border-danger': errors.SKU !== undefined}" placeholder="Number of each product"/>

                        </div>
                        <div class="col-4">
                            <label class="form-label">Price <span v-if="errors.price !== undefined" class="text-danger">:is require</span></label>
                            <input v-model="product.price" type="text" name="price"
                                   class="form-control" v-bind:class="{'border-danger': errors.price !== undefined}"
                                   placeholder="price can be number or decimal"/>
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
                            <div class="row">
                                <label  class="form-label col-12">Image:</label>
                                <div class="col-3">
                                    <img v-if="product.image != null" class="w-100" :src="`/storage/images/${product.image}`" />
                                </div>
                                <vue-dropzone class="col-9" ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
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
        </section>
        <section class="bl-footer"></section>
    </main>
</template>
<script>
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.min.css';
    export default {
        components: {
            vueDropzone: vue2Dropzone
        },
        props: {
            id: '',
            initId: String,
            initProduct: Array,
            initCategories: Array,
        },
        data() {
            return {
                // id: _.cloneDeep(this.initId),
                product: _.cloneDeep(this.initProduct),
                categories: _.cloneDeep(this.initCategories),
                dropzoneOptions: {
                    url: '/api/product/upload-image',
                    thumbnailWidth: 300,
                    maxFilesize: 2, // The max file size is 2 MP
                    headers: { 'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content },
                    success(file, res) {
                        file.filename = res;
                    }
                },
                errors: []
            }
        },
        created() {
            // this.id = this.$route.params.id;
            axios
                .get('/api/product/' + this.id)
                .then((res) => {
                    if(res.data.isFound === true) {
                        this.product = res.data.product;
                        console.log(this.product.image);
                        console.log(this.product)
                    }
                })
            ;

            axios.get('/api/categories/')
                .then((res) => {
                    this.categories = res.data;
                })
            ;
        },
        methods: {
            update() {
                // clone only field that we need to update
                // rather than send ton of observer object and functions to server
                let updateProduct = {
                    id: this.id,
                    product_name: this.product.product_name,
                    slug: this.product.slug,
                    SKU: this.product.SKU,
                    category_id: this.product.category_id,
                    price: this.product.price,
                    size: this.product.size,
                    profile:this.product.profile,
                    details: this.product.details,
                    our_story: this.product.our_story,
                    image: this.product.image,
                    available:this.product.available,
                    origin: this.product.origin,
                    available_at: this.product.available_at
                };

                let files = this.$refs.myVueDropzone.getAcceptedFiles();
                if(files.length > 0 && files[0].filename){
                    updateProduct.image = files[0].filename;
                }
                // console.log(this.product.image);
                axios.put('/api/product/update/', updateProduct)
                .then(res => {

                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    // console.log(error.response.data.errors);
                })
                ;
            },
            generateSlug() {
                //replace space with
                this.product.slug = this.product.product_name.trim().replace(/\s/g, '-');
            },
            beforeRouteLeave(to, from, next) {
                if(confirm('Some part is unsaved, do you want to leave?')){
                    next();
                }
            }
        }
    }
</script>
