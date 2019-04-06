
@extends('blog.layouts.master')
@section('title')  All Products @endsection

@section('content')
    <header>
        <h5 class="text-center">    <i class="fa fa-chevron-left"></i>
            WE ALWAYS HERE FOR YOU    <i class="fa fa-chevron-right"></i>
        </h5>
        @include('blog.includes.nav')
        {{--<h3 class="text-center">WELCOME</h3>--}}
    </header>
    <main>
        @if($products->count())
        <div class="our-work">
            <div class="container">
                <h2 class="text-center">
                   Our Products
                </h2>
                <div class="products">
                    <div class="row">
                        @forelse($products as $product)
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 text-center" >
                                <div class="product-item" >
                                <!--<p class="cover-text" ><a v-bind:href="product.link">{{$product->title}}</a></p>-->
                                    <div class="cover">
                                        <div class="text">
                                            <h3>{{$product->title}}</h3>
                                            <p>{{$product->slug}} .... <a href="{{route('products.show',$product->id)}}">learn more</a> </p>
                                        </div>
                                    </div>
                                    <div class="image">
                                        <picture>
                                            {{--<source media="(min-width:100px)  and (max-width : 599px)"      srcset="{{$product->cover[400]}}"     >--}}
                                            {{--<source media="(min-width : 600px) and (max-width: 991px)"      srcset="{{$product->cover[550]}}"     >--}}
                                            {{--<source media="(min-width : 992px) and (max-width: 1023px)"     srcset="{{$product->cover[750]}}"     >--}}
                                            {{--<source media="(min-width  : 1024px) and (max-width: 1200px)"   srcset="{{$product->cover[1024]}}"    >--}}
                                            <img src="{{asset('storage/product/'.$product->cover)}}" class="img-responsive">
                                        </picture>

                                    </div>

                                </div>
                            </div>

                            @empty
                            @endforelse


                    </div>
                </div>

                <div class="pagination-work">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="{{(!$products->previousPageUrl())? 'disabled':''}}">
                                    @if($products->previousPageUrl())
                                    <a aria-label="Previous" href="{{$products->previousPageUrl()}}">
                                        <span aria-hidden="true">prev</span><!--&laquo;-->
                                    </a>
                                        @else
                                    <a  aria-label="Previous" disabled="">
                                        <span aria-hidden="true">prev</span><!--&laquo;-->
                                    </a>
                                        @endif

                            </li>


                            @for($i=1; $i<= $products->lastPage();$i++)
                                <li  class="{{$i == $products->currentPage() ? 'active':''}}"><a href="{{$products->url($i)}}">{{$i}}</a></li>
                            @endfor

                            <li   class="{{(!$products->nextPageUrl())? 'disabled':''}}">
                                @if($products->nextPageUrl())
                                    <a aria-label="next" href="{{$products->nextPageUrl()}}">
                                        <span aria-hidden="true">next</span><!--&laquo;-->
                                    </a>
                                @else
                                    <a  aria-label="next" disabled="">
                                        <span aria-hidden="true">next</span><!--&laquo;-->
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </nav>

                </div>

            </div>

        </div>
        @endif
    </main>
@endsection
