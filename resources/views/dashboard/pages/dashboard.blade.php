@extends('dashboard.layouts.master')

@section('title') Dashboard @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-book fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$categoryCount}}</div>
                                <div>Categories!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('categories.index')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>

                </div>
               <p><a href="{{route('categories.create')}}" class="btn btn-primary btn-block btn-lg">Add New Category</a></p>
               <p><a href="{{route('categories.index')}}" class="btn btn-success btn-block btn-lg">All Categories</a></p>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$productCount}}</div>
                                <div>Products</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('products.index')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
                <p><a href="{{route('products.create')}}" class="btn btn-primary btn-block btn-lg">Add New Product</a></p>
                <p><a href="{{route('products.index')}}" class="btn btn-success btn-block btn-lg">All Products</a></p>
            </div>



            {{--<div class="col-lg-3 col-md-6">--}}
                {{--<div class="panel panel-yellow">--}}
                    {{--<div class="panel-heading">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-xs-3">--}}
                                {{--<i class="fa fa-shopping-cart fa-5x"></i>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-9 text-right">--}}
                                {{--<div class="huge">{{$imageCount}}</div>--}}
                                {{--<div>Images</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<a href="#">--}}
                        {{--<div class="panel-footer">--}}
                            {{--<span class="pull-left">View Details</span>--}}
                            {{--<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>--}}
                            {{--<div class="clearfix"></div>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-3 col-md-6">--}}
                {{--<div class="panel panel-red">--}}
                    {{--<div class="panel-heading">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-xs-3">--}}
                                {{--<i class="fa fa-support fa-5x"></i>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-9 text-right">--}}
                                {{--<div class="huge">13</div>--}}
                                {{--<div>Support Tickets!</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<a href="#">--}}
                        {{--<div class="panel-footer">--}}
                            {{--<span class="pull-left">View Details</span>--}}
                            {{--<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>--}}
                            {{--<div class="clearfix"></div>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>





    </div>
    @endsection