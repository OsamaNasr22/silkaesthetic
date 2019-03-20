@extends('dashboard.layouts.master')
@section('title') Products @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Products</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="table-responsive">
                @if($products)
                    <table class="table table-striped table-bordered table-hover ">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Product title</th>
                            <th>slug</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($products as $product)
                            <tr >
                                <td>{{$product['id']}}</td>
                                <td>{{$product['title']}}</td>
                                <td>{{$product['slug']}}</td>
                                <td id="manage">
                                    <form method="post" action="{{route('products.destroy',$product['id'])}}" style="display: inline">
                                        {{method_field('delete')}}
                                        @csrf
                                        <a class='delete btn btn-danger' href="" ><i class="fa fa-remove "></i> Delete</a>
                                    </form>
                                    <a href="{{route('products.edit',$product['id'])}}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                </td>
                            </tr>

                        @empty
                            <div class="alert alert-warning">No products added yet </div>
                        @endforelse


                        </tbody>
                    </table>
@else
                    <div class="alert alert-warning">No products added yet <a href="{{route('products.create')}}">Add Now</a> </div>

                @endif
            </div>

        </div>

    </div>
@endsection

