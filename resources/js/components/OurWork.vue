<template>
    <div class="our-work">
        <div class="container">
            <h2 class="text-center">
                {{category_name}}
            </h2>
            <div class="products">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 text-center" v-for="product in products" >
                        <div class="product-item" >
                            <!--<p class="cover-text" ><a v-bind:href="product.link">{{product.title}}</a></p>-->
                            <div class="cover">
                                <div class="text">
                                    <h3>{{product.title}}</h3>
                                    <p>{{product.slug}} .... <a v-bind:href="product.link">learn more</a> </p>
                                </div>
                            </div>
                            <div class="image">
                                <picture>
                                    <source media="(min-width:100px)  and (max-width : 599px)"      v-bind:srcset="product.cover[400]"     >
                                    <source media="(min-width : 600px) and (max-width: 991px)"      v-bind:srcset="product.cover[550]"     >
                                    <source media="(min-width : 992px) and (max-width: 1023px)"     v-bind:srcset="product.cover[750]"     >
                                    <source media="(min-width  : 1024px) and (max-width: 1200px)"   v-bind:srcset="product.cover[1024]"    >
                                    <img v-bind:src="product.cover['larger']" class="img-responsive">
                                </picture>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="pagination-work">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li  v-bind:class="[{disabled : !pagination.prev_page }]" >

                            <a v-if="!pagination.prev_page" aria-label="Previous" @click.prevent="">
                                <span aria-hidden="true">prev</span><!--&laquo;-->
                            </a>
                            <a v-else   aria-label="Previous" @click.prevent="fetchProducts(pagination.prev_page)">
                                <span aria-hidden="true">prev</span><!--&laquo;-->
                            </a>
                        </li>

                        <li v-for="i in pagination.last_page" v-bind:class="[{active : pagination.current_page === i }]" @click.prevent="fetchProducts(`${url}?page=${i}`)"><a href="#">{{i}}</a></li>

                        <li   v-bind:class="[{disabled : !pagination.next_page}]">

                            <a v-if="!pagination.next_page" aria-label="Next"  @click.prevent="">
                                <span  aria-hidden="true">next</span> <!--&raquo;-->
                            </a>
                            <a v-else  aria-label="Next"  @click.prevent="fetchProducts(pagination.next_page)">
                                <span  aria-hidden="true">next</span> <!--&raquo;-->
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>

        </div>

    </div>
</template>

<script>
    export default {
        props: ['category'],
        data(){
            return {
                category_id:this.category,
                show: false,
                products :[],
                category_name:'',
                pagination : {},
                url:''
            }  ;
        },
        created(){
            this.fetchProducts();
        },

        methods:{
            fetchProducts(url= null){
                let vm = this;
                if (! url){
                    if (this.category_id){
                        this.url= 'http://www.silkaesthetic.com/api/products/'+this.category_id;
                    }else {
                        this.url ='http://www.silkaesthetic.com/api/products/'
                    }
                } else {
                    this.url = url;
                }
                fetch(this.url).then(res => res.json()).then( res => {
                    this.products= res.data;
                    vm.preparePagination(res.links,res.meta);
                    this.category_name=(this.category_id)? res.data[0]['category_name']:'Our Products';
                    if (this.category_id){
                        this.url= 'http://www.silkaesthetic.com/api/products/'+this.category_id;
                    }else {
                        this.url ='http://www.silkaesthetic.com/api/products/'
                    }
                });
            } ,
            preparePagination(links,meta){
                let pagination = {
                    first_page_link : links.first,
                    last_page_link:links.last,
                    next_page:links.next,
                    prev_page:links.prev,
                    total:meta.total,
                    current_page:meta.current_page,
                    last_page:meta.last_page,
                    from:meta.from
                }
                this.pagination= pagination;


            }
        }

    }
</script>
