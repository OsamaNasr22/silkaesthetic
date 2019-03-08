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
            <div class="tabs">

                <div class="container">
                    <h3 class="">| Filler</h3>
                    <div class="row">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Introduction</a></li>
                                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Benifits</a></li>
                                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                                <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="media">
                                       <div class="row">
                                           <div class="media-left">
                                               <a href="#">
                                                   <img class="media-object" src="https://via.placeholder.com/300x300" alt="...">
                                               </a>
                                           </div>
                                           <div class="media-body">
                                               {{--<h4 class="media-heading">Media heading</h4>--}}
                                               Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                               Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                           </div>
                                       </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <div class="media">

                                            <div class="media-left">
                                                {{--<a href="#">--}}
                                                    {{--<img class="media-object" src="https://via.placeholder.com/300x300" alt="...">--}}
                                                {{--</a>--}}
                                            </div>
                                            <div class="media-body">
                                                {{--<h4 class="media-heading">Media heading</h4>--}}
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                            </div>
                                        </div>

                                </div>
                                <div role="tabpanel" class="tab-pane" id="messages">
                                    <div class="media">
                                        <div class="row">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="https://via.placeholder.com/300x300" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                {{--<h4 class="media-heading">Media heading</h4>--}}
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="settings">
                                    <div class="media">
                                        <div class="row">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="https://via.placeholder.com/300x300" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                {{--<h4 class="media-heading">Media heading</h4>--}}
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-primary pull-right" style="background-color: #1BBDE8; border: 1px solid #1BBDE8; padding: 10px 30px; border-radius: 20px" href="{{route('category.products',1)}}" >Products</a>
                    </div>
                </div>

            </div>




    </main>




    @endsection

@section('style')
    <style>
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
    </style>

    @endsection


@section('js')

    @endsection