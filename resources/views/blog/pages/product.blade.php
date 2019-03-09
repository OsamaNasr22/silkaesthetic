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
            <img src="{{$product['cover']}}" class="img-responsive" id="currentImage">
        </div>
        <div class="demo">
            <div class="item">
                <ul id="content-slider" class="content-slider">

                    <li class="image">
                        <img width="150" height="150" class="selected img-circle active"  src="{{$product['cover']}}">
                    </li>
                    @forelse($product['images'] as $key =>$image)
                        <li class="image">
                            <img width="150" height="150" class=" img-circle" src="{{asset('storage/product/'.$image['image_url'])}}">
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
        <div class="extra_images">
            <div class="container">
                <div class="row">
                    <h2 class="extra_heading">| Look more!</h2>
                    @forelse($product['extra_images'] as $image)
                        <div class="col-xs-12 col-md-6">
                            <img style="width: 100%" class="img-responsive" src="{{asset($image)}}">
                        </div>
                        @empty
                        @endforelse

                    {{--<div class="col-xs-12 col-md-6">--}}
                        {{--<img style="width: 100%"  class="img-responsive" src="https://via.placeholder.com/456x323">--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </main>




@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/lightslider.min.css')}}">
    <style>

      /*  #myCarousel{
            width: 33%;
            margin: -60px auto;
            top: -90px;
        }
        .carousel-inner .active.left  { left: -33%;             }
        .carousel-inner .active.right { left: 33%;              }
        .carousel-inner .next         { left: 33%               }
        .carousel-inner .prev         { left: -33%              }
        .carousel-control.left        { background-image: none; }
        .carousel-control.right       { background-image: none; }
        .carousel-inner .item         { background: white;      }
        .carousel-inner .item img{

        }*/
      ul{
          list-style: none outside none;
          padding-left: 0;
          margin: 0;
      }
      .demo
      {
          position: relative;
          top: -176px;
          margin: 0 auto;
          margin-bottom: -211px;
      }
      .demo .item{
          margin-bottom: 60px;
      }
      .content-slider li{
          /*background-color: #ed3020;*/
          text-align: center;
          color: #FFF;

      }
      .content-slider h3 {
          margin: 0;
          padding: 70px 0;
      }
      .demo{
          width: 800px;
      }
        .category_cover{
            width: 100%;
            height: 482px;
        }
        .category_cover img{
            min-height: 482px;
            max-height: 482px;
            width: 100%;
        }
        .selected{
            border: 1px solid #333  ;
        }

        .desc_heading , .extra_heading{
            color: #10C8E5;
            font-family: "Raleway", Tahoma;
            margin: 20px 0;
            font-weight: 600;
        }
        .category_description{
            padding: 20px;
        }
        .desc_body{
            padding: 20px;
            line-height: 2.4em;
            font-size: 18px;
            word-break: break-all;
        }
        .extra_images{
            padding: 50px 20px 70px 20px;
        }
        .extra_images img{
            min-height:450px ;
            max-height: 450px;

        }
        .demo li img{
            opacity: 0.7;
            transition: opacity .10s ease-in-out;
            max-height: 100%;
        }
        .demo li img.active{
            opacity: 1;
        }
      .lSAction>.lSNext {
          background-position: -155px -28px
      }
      .lSAction>.lSPrev {
          background-position: -70px -28px
      }

      .


    </style>

@endsection
@section('js')

    <script>
        (function () {
            const currentImage= document.querySelector('#currentImage');


            $('#content-slider').on('click','.image',changeCurrent);
            // images.forEach((image) =>{
            //
            //     // image.addEventListener('click',changeCurrent)
            //     // image.querySelector('img').classList.remove('selected', 'active')
            // });
            function changeCurrent(e) {
                const images = document.querySelectorAll('.image');
                images.forEach((image) => image.querySelector('img').classList.remove('selected', 'active'));
                let image= this.querySelector('img');
                let src= image.src;
                this.querySelector('img').classList.add('selected','active');
                currentImage.classList.remove('active');
                currentImage.src = src;
                // image.addEventListener('transitionend',function () {
                //
                //     // image.classList.add('active');
                // });

            }



        })();


    </script>

    <script src="{{asset('js/lightslider.min.js')}}"></script>
<script>
   $(function () {
       $("#content-slider").lightSlider({
           loop:true,
           keyPress:true
       });
       $('#image-gallery').lightSlider({
           autoWidth: "106",
           gallery:true,
           item:1,
           thumbItem:9,
           slideMargin: 0,
           speed:500,
           auto:true,
           loop:true,
           onSliderLoad: function() {
               $('#image-gallery').removeClass('cS-hidden');
           }
       });
       /*    $('#myCarousel').carousel({
               interval: 10000
           });

           $('.carousel .item').each(function(){
               var next = $(this).next();
               console.log(next);
               if (!next.length) {
                   next = $(this).siblings(':first');
               }
               next.children(':first-child').clone().appendTo($(this));

               if (next.next().length>0) {
                   next.next().children(':first-child').clone().appendTo($(this));
               }
               else {
                   $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
               }
           });*/



   });
</script>
@endsection