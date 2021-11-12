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
                    <th>Actions</th>
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
                        <td>
                            <div class="d-inline-block w-100">
                                <button v-b-modal.modal-1 class="btn btn-outline-secondary btn-sm rounded-circle">
                                    <i class="bi-check-circle-fill"></i>
                                </button>
                                <button
                                    @click="showDeleteModel(product.id)"
                                    v-b-modal.modal-1
                                    class="btn btn-outline-secondary btn-sm rounded-circle">
                                    <i class="bi-trash-fill"></i>
                                </button>
                                <button class="btn btn-outline-secondary btn-sm text-dark rounded-circle">
                                    <i class="bi-pencil-fill"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <b-modal
                id="modal-1"
                title="Alert"
                @ok="deleteProduct()"
                ok-title = "Delete"
            >
                <p class="text-dark">Are you sure want to delete this item?</p>
            </b-modal>
            <div class="position-relative">
                <div v-if="this.isNotify == true" class="fixed-bottom-right">
                    <div class="alert alert-success text-sm-center" role="alert">
                        <b-spinner v-if="this.isLoading == true" small variant="secondary" label="Spinning"></b-spinner>
                        <i v-if="isSuccess == true" class="bi-check-circle-fill"></i>
                        {{this.notificationMessage}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end block-01 -->
</template>
<script>
export default {
    props: ["initialProducts"],
    data(){
        return{
            products: _.cloneDeep(this.initialProducts),
            feedback: '',
            selectedProduct: Array,
            selectedIndex: 0,


            notificationMessage: '',
            isNotify: false,
            isLoading: true,
            isSuccess: false

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
        // To show information on pop up dialog box
        showDeleteModel (curId) {
            this.selectedProduct = this.findCurrentProduct(curId);
        },
        // To find product was selected
        // pass the array object value to a prop property
        // in order access once we need it
        findCurrentProduct(productId)  {
            let currentProduct = Array;
            for(const [index, product] of this.products.entries()) {
                if (productId == product.id) {
                    currentProduct = product;
                    // set current index to remove product in Array Collection
                    // after server side data removed
                    this.selectedIndex = index;
                }
            }
            return currentProduct;
        },
        deleteProduct() {
            this.isNotify = true;
            this.isSuccess = false;
            this.notificationMessage = 'working...';
            axios.delete('/api/product/destroy', {id: this.selectedProduct.id})
                .then((res) => {
                    this.products.splice(this.selectedIndex, 1);
                    this.isLoading = false;
                    this.isSuccess = true;
                    this.notificationMessage = 'The item is removed.';
                    setInterval( () => {
                        this.isNotify = false;
                    }, 3000);

                })
                // error.response.data.errors
                // to show each message of all error messages
                .catch((error) => {
                    console.log(error.response.data.errors);
                })
            ;
        }



    }


}
</script>
