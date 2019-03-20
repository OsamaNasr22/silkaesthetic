@extends('blog.layouts.master')
@section('title') {{$product['title']}} @endsection

@section('content')
    <header>
        <h5 class="text-center">    <i class="fa fa-chevron-left"></i>
            WE ALWAYS HERE FOR YOU    <i class="fa fa-chevron-right"></i>
        </h5>
        @include('blog.includes.nav')
        <h3 class="text-center">WELCOME</h3>
    </header>
    <main>
        <div class="category_cover">
            <picture>
                <source media="(min-width:100px)  and (max-width : 599px)"      srcset="{{$product['cover'][400]}} " class="source">
                <source media="(min-width : 600px) and (max-width: 991px)"      srcset="{{$product['cover'][550]}}" class="source">
                <source media="(min-width : 992px) and (max-width: 1023px)"     srcset="{{$product['cover'][750]}}" class="source">
                <source media="(min-width  : 1024px) and (max-width: 1200px)"   srcset="{{$product['cover'][1024]}}" class="source">
                <img src="{{$product['cover']['larger']}}" class="img-responsive" id="currentImage">
            </picture>

        </div>
        <div class="demo">
            <div class="item">
                <ul id="content-slider" class="content-slider">

                    <li class="image">
                        <picture>
                            <source media="(min-width:100px)  and (max-width : 599px)"      srcset="{{$product['cover'][400]}} ">
                            <source media="(min-width : 600px) and (max-width: 991px)"      srcset="{{$product['cover'][550]}}">
                            <source media="(min-width : 992px) and (max-width: 1023px)"     srcset="{{$product['cover'][750]}}">
                            <source media="(min-width  : 1024px) and (max-width: 1200px)"   srcset="{{$product['cover'][1024]}}">
                            <img  class="selected img-circle active"  src="{{$product['cover']['larger']}}">
                        </picture>
                    </li>
                    @forelse($product['imagesResolution'] as $key =>$image)
                        <li class="image">
                            <picture>
                                <source media="(min-width:100px)  and (max-width : 599px)"      srcset="{{$image[400]}} ">
                                <source media="(min-width : 600px) and (max-width: 991px)"      srcset="{{$image[550]}}">
                                <source media="(min-width : 992px) and (max-width: 1023px)"     srcset="{{$image[750]}}">
                                <source media="(min-width  : 1024px) and (max-width: 1200px)"   srcset="{{$image[1024]}}">
                                <img  class=" img-circle" src="{{$image['larger']}}">

                            </picture>
                        </li>
                    @empty
                        @endforelse
                 {{--   <li >
                        <img class="selected img-circle" src="https://via.placeholder.com/150">
                    </li>  <li>
                        <img class="img-circle" src="https://via.placeholder.com/150">
                    </li>  <li>
                        <img class="img-circle" src="https://via.placeholder.com/150">
                    </li>  <li>
                        <img class="img-circle" src="https://via.placeholder.com/150">
                    </li>--}}
                </ul>
            </div>

        </div>

        <div class="category_description">
            <div class="container">
               <div class="row">
                   <h2 class="desc_heading">| {{$product['title']}}</h2>
                   <div class="desc_body">
                    <p>
                        {!! html_entity_decode($product['description']) !!}
                    </p>
                   </div>
               </div>
            </div>
        </div>
        @if($product['extra_imagesResolution'])
            <div class="extra_images">
                <div class="container">
                    <div class="row">
                        <h2 class="extra_heading">| Look more!</h2>
                        @forelse($product['extra_imagesResolution'] as $image)
                            <div class="col-xs-12 col-md-6">
                                <picture>
                                    <source media="(min-width:100px)  and (max-width : 700px)"   srcset="{{$image[400]}} ">
                                    <img style="width: 100%" class="img-responsive" src="{{$image['larger']}}">

                                </picture>
                            </div>
                        @empty
                        @endforelse

                        {{--<div class="col-xs-12 col-md-6">--}}
                        {{--<img style="width: 100%"  class="img-responsive" src="https://via.placeholder.com/456x323">--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
            @endif

    </main>




@endsection

@section('style')
    {{--<link rel="stylesheet" href="{{asset('css/lightslider.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dist/product.min.css')}}">
@endsection
@section('js')
    <script src="{{asset('dist/product.js')}}"></script>
@endsection