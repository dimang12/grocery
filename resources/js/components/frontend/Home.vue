<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col-7">
                <!-- Start carousel -->
                <b-carousel
                    id="carousel-1"
                    v-model="slide"
                    :interval="8000"
                    controls
                    indicators
                    background="#ababab"
                    img-height="480"

                    style="text-shadow: 1px 1px 2px #333;"
                    @sliding-start="onSlideStart"
                    @sliding-end="onSlideEnd"
                >
                    <!-- Text slides with image -->
                    <b-carousel-slide v-if="products.length > 0" v-for="(product,index) in products" >

                        <template #img>
                            <img
                                class="d-block w-100 overflow-hidden"
                                :src="`/storage/images/${product.image}`"
                                alt="image slot"
                            >
                        </template>

                        <h1>{{product.product_name}}</h1>
                    </b-carousel-slide>
                </b-carousel>
                <div class="position-relative ">
                    <a href="" class="info p-3 text-dark">
                        <h4 class="font-24 title">
                            Testing title
                        </h4>
                        <p class="short-desc m-0 p-0 text-dark">នេះជាលើកទីមួយហើយដែល រូបរាងរបស់ Apple Watch ត្រូវបានគេផ្លាស់ប្តូរបើ​គិតចាប់ពី នាឡិកាអេឡិចត្រូនិចចាប់ប្រកាសលើកដំបូងនៅឆ្នាំ 2014 ។ លោក John Proccer បានបន្តថា នាឡិកា Apple Watch 7 នឹងមានព៌ណបៃតងខ្ចី  ព៌ណផ្ទៃមេឃ នឹងមានព៌ណផ្សេងទៀត លំនាំគ្នាទៅនឹង iPad Air និង iMac ដែរ</p>
                    </a>
                </div>
                <!-- End carousel -->

            </div>
            <div class="col-5">test</div>
        </div>
    </div>
</template>
<script>
    import store from '../../store/index';
    export default {
        store,
        // props: [],
        data(){
          return {
            // products: this.$store.state.products,
            slide: 0,
            sliding: null
          }
        },
        computed:{
            products() {
                return this.$store.state.products;
            }
        },
        mounted() {
            if(this.$store.state.products.length <= 0){
                axios.get('/api/products/').then((res) => {
                   this.$store.commit('SET_PRODUCTS', res.data.products);
                })
                .catch((errors) => {
                    console.log(error.response.data.errors);
                })
                ;
            }
        },
        methods: {
            onSlideStart(slide) {
                this.sliding = true
            },
            onSlideEnd(slide) {
                this.sliding = false
            }
        }
    }
</script>
