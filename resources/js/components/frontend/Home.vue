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
                    <b-carousel-slide
                        v-for="(product,index) in products"
                        v-bind:key="product.id"
                        v-if="index < 3"
                    >
                        <template #img>
                            <img
                                class="d-block w-100 overflow-hidden"
                                :src="`/storage/images/${product.image}`"
                                alt="image slot"
                            >
                        </template>
                        <h1>{{product.product_name}}</h1>
                        <p>{{product.profile}}</p>
                    </b-carousel-slide>
                </b-carousel>
                <!-- End carousel -->
                <!-- Start two items in a row -->
                <div class="row ">
                    <div class="col-6 pt-4" v-for="(product, index) in products" v-if="index > 3 && index <= 7">
                        `<b-card
                            v-bind:data="product"
                            v-bind:key="index"
                            img-alt="Image"
                            img-top
                            tag="article"
                            class="min-height-450"
                            v-if="product.image != null"
                            :img-src="'/storage/images/' + product.image"
                        >
                            <b-card-title>{{product.product_name}}</b-card-title>
                            <b-card-text>
                                {{product.profile}}
                            </b-card-text>
                            <b-button href="#" variant="primary">Detail</b-button>
                        </b-card>`
                        <b-card
                            v-bind:data="product"
                            v-bind:key="index"
                            img-alt="Image"
                            img-top
                            tag="article"
                            class="min-height-450"
                            v-if="product.image == null"
                            img-src="https://picsum.photos/600/300/?image=25"
                        >
                            <b-card-title>{{product.product_name}}</b-card-title>
                            <b-card-text>
                                {{product.profile}}
                            </b-card-text>
                            <b-button href="#" variant="primary">Detail</b-button>
                        </b-card>

                    </div>

                </div>
                <!-- End two items in a row -->

            </div>
            <div class="col-5">
                <!-- Start right side -->
                <ul>
                    <li class="row" v-for="(product, index) of products" v-if="index > 7">
                        <aside class="col-3">
                            <img v-if="product.image == null" class="w-100" :src="'/img/whollycity-logo.png'" />
                            <img v-if="product.image != null" class="w-100" :src="'/storage/images/' + product.image" />
                        </aside>
                        <article class="col-9">
                            <b>{{ product.product_name }}</b>
                            <p>{{product.profile}}</p>
                        </article>
                    </li>
                </ul>
                <!-- End the right side -->
            </div>
        </div>
        <div class="row m-0 mt-5">
            <b-jumbotron class="col-12" header="Where is Ads would be" lead="Bootstrap v4 Components for Vue.js 2">
                <p>For more information visit website</p>
                <b-button variant="primary" href="#">More Info</b-button>
            </b-jumbotron>
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
