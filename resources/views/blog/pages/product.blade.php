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


        <div id="myCarousel" class="carousel slide">

            <div class="carousel-inner">
                <div class="item active">
                    <div class="col-xs-4"><a href="#"><img src="http://placehold.it/500/bbbbbb/fff&amp;text=1" class="img-responsive img-circle"></a></div>
                </div>
                <div class="item">
                    <div class="col-xs-4"><a href="#"><img src="http://placehold.it/500/CCCCCC&amp;text=2" class="img-responsive img-circle"></a></div>
                </div>
                <div class="item">
                    <div class="col-xs-4"><a href="#"><img src="http://placehold.it/500/eeeeee&amp;text=3" class="img-responsive img-circle"></a></div>
                </div>
                <div class="item">
                    <div class="col-xs-4"><a href="#"><img src="http://placehold.it/500/f4f4f4&amp;text=4" class="img-responsive img-circle"></a></div>
                </div>
                <div class="item">
                    <div class="col-xs-4"><a href="#"><img src="http://placehold.it/500/fcfcfc/333&amp;text=5" class="img-responsive img-circle"></a></div>
                </div>
                <div class="item">
                    <div class="col-xs-4"><a href="#"><img src="http://placehold.it/500/f477f4/fff&amp;text=6" class="img-responsive img-circle"></a></div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="color: #000;left: -12px"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: #000;right: -12px"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class=""></div>
    </main>




@endsection

@section('style')
    <style>

        #myCarousel{
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


    </style>

@endsection


@section('js')
<script>
   $(function () {
       $('#myCarousel').carousel({
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
       });
   });
</script>
@endsection