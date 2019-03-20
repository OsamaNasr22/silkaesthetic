<div class="slider">
    <div class="slider-cover"></div>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @for($i=0,$c=count($sliders);$i<$c;$i++)
                <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="{{$i==0?'active':''}}"></li>
            @endfor
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">

            @forelse($sliders as $key => $value)

                <div class="item {{$key == 0 ? 'active': ''}}">
                    <picture>
                        <source media="(min-width:100px)  and (max-width : 599px)"  srcset="{{asset('storage/banners/'.$value->imageResoulutions[400])}} ">
                        <source media="(min-width : 600px) and (max-width: 991px)"  srcset="{{asset('storage/banners/'.$value->imageResoulutions[550])}}">
                        <source media="(min-width : 992px) and (max-width: 1023px)"  srcset="{{asset('storage/banners/'.$value->imageResoulutions[750])}}">
                        <source media="(min-width  : 1024px) and (max-width: 1200px)" srcset="{{asset('storage/banners/'.$value->imageResoulutions[1024])}}">
                        <img src="{{asset('storage/banners/'.$value->image)}}"alt="..." >
                    </picture>

                </div>
                @empty

                @endforelse

            {{--<div class="item">--}}
                {{--<img src="{{asset('images\WhatsAppImage2018-09-11at23.49.22.png')}}" alt="..." >--}}

            {{--</div>  <div class="item">--}}
                {{--<img src="{{asset('images\WhatsAppImage2018-09-11at23.49.22.png')}}" alt="..." >--}}

            {{--</div>--}}

        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="test"></div>
</div>
