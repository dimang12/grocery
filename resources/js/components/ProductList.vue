<template>
    <div class="block-01">
        <h3 class="bl-header pt-3 pb-3 mb-4">
            <div class="row">
                <div class="col-8">
                    List of Products 
                </div>
                <div class="col-4 actions text-right">
                    <router-link class="btn btn-light text-dark" :to="{name: 'new-product'}">
                        <i class="bi-plus-circle-fill"></i> 
                        <span>New product</span>
                    </router-link>
                </div>
            </div>
            
            
        </h3>
        <div class="bl-body">
            <table class="table table-bordered">
                <thead>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Size/Qty</th>
                    <th>Price</th>
                    <th>Views</th>
                </thead>
                <tbody>
                    <tr v-for="product in products" :value="product.id" :key="product.id" >
                        <td>{{ "_" }}</td>
                        <td>
                            <router-link :to="{name: 'product-detail', params: {id: product.id}}">{{ product.product_name }}</router-link>  
                        </td>
                        <td>{{ product.size }}</td>
                        <td>$ {{ product.price }}</td>
                        <td>{{ product.views }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    props: ["initialProducts"],
    data(){
        return{
            products: _.cloneDeep(this.initialProducts),
            feedback: '',
        };
    },
    created(){
        axios
            .get('/api/products/')
            .then((res) => {
                // console.log(this.products);
                this.products = res.data.products;
            })
        ;
    },
    methods: {
        
    }

    
}
</script>