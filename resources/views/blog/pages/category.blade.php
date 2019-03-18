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
            <img src="{{asset('storage/product/'.$category['cover'])}}" class="img-responsive">
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
                                                            <img class="media-object" src="{{asset('storage/extra_images/'.$option['image'])}}" alt="...">
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
    <style>
        .media-body{
            word-break: break-all;
            padding: 20px;
        }
        .tabs{
            padding: 30px 10px;
            background-color: #fff;
        }
        .tabs h3{
            margin-bottom: 30px;
            text-indent: 30px;
            color: #10C8E5;
            font-family: "Raleway", Tahoma;
            font-weight: 600;
        }
        .tab-pane{
            padding: 20px;
            /*border: 1px solid #ddd;*/
        }
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
            color: #fff !important;
            background-color: #10C8E5 !important;
        }
        .tabs ul.nav{
            background-color: #F1F5F4;
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
        .media-left img{
            min-width: 300px;
            max-width: 300px;
            min-height: 300px;
            max-height: 300px;
        }
    </style>

    @endsection


@section('js')

    @endsection