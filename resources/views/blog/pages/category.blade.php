@extends('blog.layouts.master')
@section('title') {{$category['name']}} @endsection

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
                <source media="(min-width:100px)  and (max-width : 599px)" srcset="{{asset('storage/product/'.$category->coverResolutions[400])}} ">
                <source media="(min-width : 600px) and (max-width: 991px)" srcset="{{asset('storage/product/'.$category->coverResolutions[550])}}">
                <source media="(min-width : 992px) and (max-width: 1023px)" srcset="{{asset('storage/product/'.$category->coverResolutions[750])}}">
                <source media="(min-width  : 1024px) and (max-width: 1200px)" srcset="{{asset('storage/product/'.$category->coverResolutions[1024])}}">
                <img src="{{asset('storage/product/'.$category['cover'])}}" class="img-responsive">
            </picture>
        </div>
            <div class="tabs">

                <div class="container">
                    <h3 class="">| {{$category['name']}}</h3>
                    <div class="row">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                @forelse($category['options'] as $key=> $option)
                                    <li role="presentation" class="{{$key==0?'active':''}}"><a href="#option{{$option['id']}}" aria-controls="home" role="tab" data-toggle="tab">{{$option['key']}}</a></li>
                                @empty
                        <div class="alert alert-warning">No option added yet.</div>
                                    @endforelse

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                @forelse($category['options'] as $key => $option)
                                    <div role="tabpanel" class="tab-pane {{$key==0?'active':''}}" id="option{{$option['id']}}">
                                        <div class="media">
                                            <div class="row">
                                                <div class="media-left">
                                                    @if($option['image'])
                                                        <a href="#">
                                                            <img class="media-object img-responsive" src="{{asset('storage/extra_images/'.$option['image'])}}" alt="...">
                                                        </a>
                                                        @endif

                                                </div>
                                                <div class="media-body">
                                                    {!! html_entity_decode($option['value']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty

                                    @endforelse
                            </div>
                        </div>
                        @if($category->products->toArray())

                            <a class="btn btn-primary pull-right" style="background-color: #1BBDE8; border: 1px solid #1BBDE8; padding: 10px 30px; border-radius: 20px" href="{{route('category.products',$category['id'])}}" >Products</a>
                        @endif
                    </div>
                </div>

            </div>




    </main>




    @endsection

@section('style')
    <link rel="stylesheet" href="{{asset('dist/category.min.css')}}">
    @endsection


@section('js')

    @endsection