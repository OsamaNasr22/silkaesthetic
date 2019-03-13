@extends('dashboard.layouts.master')
@section('title') Banners @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Banners</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="table-responsive">
                @if($sliders)
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>image url</th>
                            <th>type</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($sliders as $slider)
                            <tr >
                                <td>{{$slider['id']}}</td>
                                <td>{{asset('storage/banners/'.$slider['image'])}}</td>
                                <td>{{$slider['type']}}</td>
                                <td id="manage">
                                    <form method="post" action="{{route('sliders.destroy',$slider['id'])}}" class="deleteForm">
                                        {{method_field('delete')}}
                                        @csrf
                                        {{--<i class="fa fa-remove"></i> <input type="submit" class="delete" value="Delete">--}}
                                        <a class='delete btn btn-danger' href=""><i class="fa fa-remove"></i> Delete</a>

                                    </form>
                                </td>
                            </tr>

                        @empty
                            <div class="alert alert-warning">No Banners added yet </div>
                        @endforelse


                        </tbody>
                    </table>

                @else
                    <div class="alert alert-warning">No categories added yet </div>
                @endif
            </div>

        </div>

    </div>
    @endsection

@section('js')


    @endsection