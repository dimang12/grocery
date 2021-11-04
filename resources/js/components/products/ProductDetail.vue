<template>
    <main class="block-01" v-if="product">
        <h3 class="bl-header pt-3 pb-3"> {{ product.product_name }} </h3>
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
                    <img class="w-100" :src="'/img/whollycity-logo.png'" />
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
                    console.log(this.product)
                }
            })
        ;
    },
    
}
</script>