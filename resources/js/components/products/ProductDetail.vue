<template>
    <main class="block-01" v-if="product">
        <div class="row bl-header pt-3 pb-3">
            <h3 class="col-6">
                {{ product.product_name }}
            </h3>
            <div class="col-6 text-right">
                <router-link :to="{name: 'edit-product', params:{id: id}}" class="btn btn-secondary">
                    Edit
                </router-link>
                <button class="btn btn-light text-dark" @click="$router.go(-1)">
                    <i class="bi-arrow-left-circle-fill"></i>
                    <span>Back</span>
                </button>
            </div>
        </div>
        <div class="bl-body p-3">
            <div class="row">
                <div class="col-8">
                    <div class="row">
                        <div class="col-3">Price: </div>
                        <div class="col-9">{{product.price}}</div>
                        <div class="col-3">Size: </div>
                        <div class="col-9">{{product.size}}</div>
                        <div class="col-3">Category Name: </div>
                        <div class="col-9">{{product.category_name}}</div>
                        <div class="col-3">SKU: </div>
                        <div class="col-9">{{product.SKU}}</div>
                        <div class="col-3">Origin: </div>
                        <div class="col-9">{{product.origin}}</div>
                        <div class="col-3">Availability: </div>

                        <div v-if="product.available == 1 || product.available == 0" class="col-9">Year round Product</div>
                        <div v-if="product.available == 2" class="col-9">Seasonal product</div>
                        <div v-if="product.available == 3" class="col-9">Holiday product</div>

                        <div class="col-3">Views: </div>
                        <div class="col-9">{{product.views}}</div>
                        <div class="col-3">Likes: </div>
                        <div class="col-9">{{product.interested}}</div>

                    </div>
                </div>
                <div class="col-4">
                    This space serves for showing "Limited Product" or "Year Round procut"
                </div>
            </div>
            <div class="row">
                <div class="col-4">

                    <img v-if="product.image != null" class="w-100" :src="`/storage/images/${product.image}`" />
                    <img v-if="product.image == null" class="w-100" :src="'/img/whollycity-logo.png'" />

                </div>
                <div class="col-8">
                    <section class="row">
                        <div class="col-12">
                            <h4 class="bl-header pt-3 pb-3">
                                Profile
                            </h4>
                            <div class="bl-body">
                                {{product.profile}}
                            </div>
                        </div>
                    </section>
                    <section class="row">
                        <div class="col-12">
                            <h4 class="bl-header pt-3 pb-3">
                                Detail
                            </h4>
                            <div class="bl-body">
                                {{product.details}}
                            </div>
                        </div>
                    </section>
                    <section v-if="product.our_story != null" class="row">
                        <div class="col-12">
                            <h4 class="bl-header pt-3 pb-3">
                                Our story
                            </h4>
                            <div class="bl-body">
                                {{product.our_story}}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
export default {
    props: {
        initId: String,
        initProduct: Array
    },
    data() {
        return {
            id: _.cloneDeep(this.initId),
            product: _.cloneDeep(this.initProduct)
        }
    },
    created() {
        this.id = this.$route.params.id;
        axios
            .get('/api/product/' + this.id)
            .then((res) => {
                if(res.data.isFound === true) {
                    this.product = res.data.product;
                    // console.log(this.product.image);
                    // console.log(this.product)
                }
            })
        ;
    },

}
</script>
