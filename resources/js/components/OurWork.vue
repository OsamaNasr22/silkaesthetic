<template>
    <div class="our-work">
        <div class="container">
            <h2 class="text-center">
               {{category_name}}
            </h2>
           <!-- <div class="our-work-nav text-center">
            <ul class="list-inline nav-work" >
                <li class="active" @click="fetchProducts()">ALL</li>
                <li v-for="category in categories" @click="fetchProducts(category.link)">{{category.name}}</li>
            </ul>
        </div>
            <div class="res-work text-center">
                <p>our work<i class="fa fa-arrow-down"></i></p>
                <ul>
                    <li class="active" @click="fetchProducts()">ALL</li>
                    <li v-for="category in categories" @click="fetchProducts(category.link)">{{category.name}}</li>
                </ul>

            </div>-->

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
                                <img v-bind:src="product.cover" class="img-responsive">
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

                        <li v-for="i in pagination.last_page" v-bind:class="[{active :(pagination.current_page == i)}]" @click.prevent="fetchProducts(`http://www.silkaesthetic.com/api/products/${category}?page=${i}`)"><a href="#">{{i}}</a></li>

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
                // categories:[],
                category_name:'',
                pagination : {}


            }  ;
        },

        created(){
            console.log(this.category_id);
            // this.fetchCategories();
            this.fetchProducts();
        },
      
        methods:{
            fetchProducts(url= null){
                    let vm = this;
                url = url || 'http://www.silkaesthetic.com/api/products/'+this.category_id;
                fetch(url).then(res => res.json()).then( res => {
                    this.products= res.data;
                    this.category_name=res.data[0]['category_name']
                    vm.preparePagination(res.links,res.meta);
                });
            } ,
            // fetchCategories(){
            //     fetch('api/categories').then(res => res.json()).then(res => {
            //                     this.categories = res.data;
            //     })
            // },
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
