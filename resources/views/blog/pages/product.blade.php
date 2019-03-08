@extends('blog.layouts.master')

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
            <img src="{{asset('images/moderne-vrouw-poseren-met-make-up_23-2147647712.png')}}" class="img-responsive">
        </div>
        <div class="demo">
            <div class="item">
                <ul id="content-slider" class="content-slider">
                    <li >
                        <img class="selected img-circle" src="https://via.placeholder.com/150">
                    </li>  <li>
                        <img class="img-circle" src="https://via.placeholder.com/150">
                    </li>  <li>
                        <img class="img-circle" src="https://via.placeholder.com/150">
                    </li>  <li>
                        <img class="img-circle" src="https://via.placeholder.com/150">
                    </li>
                </ul>
            </div>

        </div>

        <div class="category_description">
            <div class="container">
               <div class="row">
                   <h2 class="desc_heading">| Product name</h2>
                   <div class="desc_body">
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.

                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </p>
                   </div>
               </div>
            </div>
        </div>
        <div class="extra_images">
            <div class="container">
                <div class="row">
                    <h2 class="extra_heading">| Look more!</h2>
                    <div class="col-xs-12 col-md-6">
                        <img style="width: 100%" class="img-responsive" src="https://via.placeholder.com/456x323">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <img style="width: 100%"  class="img-responsive" src="https://via.placeholder.com/456x323">
                    </div>
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
        }
        .extra_images{
            padding: 50px 20px 70px 20px;
        }


        .


    </style>

@endsection
@section('js')
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