@extends('blog.layouts.master')

@section('content')


    @yield('content')
    <header>
        <h5 class="text-center">    <i class="fa fa-chevron-left"></i>
            WE ALWAYS HERE FOR YOU    <i class="fa fa-chevron-right"></i>
        </h5>
        @include('blog.includes.nav')
        <h3 class="text-center">WELCOME</h3>
        @include('blog.includes.slider')

    </header>

    <main>
        <div class="about-us">
            <div class="container">

                <h2 class="text-center">About us</h2>
                <p class="lead text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry s standard dummy text ever since the 1500s
                    and scrambled it to make a type specimen book. </p>

                <div class="about-us-items">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 ">
                            <div class="item-u">
                                <h6><img src="{{asset('images\flag@2x.png')}}" width="30" height="30">Our Goals</h6>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="item-u">
                                <h6><i class="fa fa-eye"></i>Our Vision</h6>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>

                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
        {{--<our-work></our-work>--}}
        <div class="our-work">
            <div class="container">
                <h2 class="text-center">
                    OUR CATEGORIES
                </h2>
                <div class="our-work-nav text-center">
                    <ul class="list-inline nav-work" >
                        {{--<li class="active" @click="fetchProducts()">ALL</li>--}}
                        @foreach($categories as $category)
                            <li ><a href="#">{{$category->name}}</a></li>
                            @endforeach

                    </ul>
                </div>
                <div class="res-work text-center">
                    <p>our categories<i class="fa fa-arrow-down"></i></p>
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="#">{{$category->name}}</a></li>
                        @endforeach
                    </ul>

                </div>

                <div class="products">
                    <div class="row">

                        @foreach($categories as $category)

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 text-center"  >
                                <div class="product-item" >

                                    <p class="cover-text" ><a href="{{route('categories.show',$category->id)}}">{{$category->name}}</a></p>

                                    <div class="cover">
                                    </div>

                                        <div class="image">

                                            <img src="{{asset('storage/product/'.$category->cover)}}" class="img-responsive">

                                        </div>


                                </div>
                            </div>


                        @endforeach

                    </div>
                </div>

               {{-- <div class="pagination-work">
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

                            <li v-for="i in pagination.last_page" v-bind:class="[{active :(pagination.current_page == i)}]" @click.prevent="fetchProducts('http://localhost:8000/api/products?page='+i)"><a href="#">{{i}}</a></li>

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

                </div>--}}

            </div>

        </div>
       {{-- <div class="partner">
            <div class="container">
                <h2 class="text-center">
                    Our partners
                </h2>

                <ul class="list-inline">
                    <li><img src="{{asset('images/Layer50@2x.jpg')}}" alt="" class="img-responsive"></li>
                    <li><img src="{{asset('images/Layer491@2x.jpg')}}" alt="" class="img-responsive"></li>
                    <li><img src="{{asset('images/Layer492@2x.jpg')}}" alt="" class="img-responsive"></li>
                    <li><img src="{{asset('images/lombardini_m33@2x.jpg')}}" alt="" class="img-responsive"></li>
                </ul>
            </div>
        </div>--}}
        <div class="contact-us">
            <div class="container">
                <h2 class="text-center">Contact us</h2>
                <div class="form">

                    @foreach($errors->all() as $error)
                        {{$error}}
                        @endforeach


                            <div class="alert message" style="display: none">

                            </div>


                    <form action="{{route('mail.send')}}" method="post" id="sendMail">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <input name="name" type="text" placeholder="Name" value="Name" :autocomplete="'off'"  >
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <input  name="sender" type="email" placeholder="E-mail" value="E-mail" autocomplete="off" >
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <input name="phone" type="text" placeholder="Phone" value="Phone" autocomplete="off">
                            </div>
                            <label >How we could help you ?</label>
                            <div class="form-group col-sm-12">
                                <textarea  name="message" rows="30" ></textarea>
                            </div>
                            <div class="form-group col-sm-12">
                                <input   type="submit" value="SEND">
                            </div>

                        </div>
                    </form>


                </div>
            </div>

        </div>

    </main>
    @endsection