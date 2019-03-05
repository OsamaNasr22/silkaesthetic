@extends('dashboard.layouts.master')

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
                            <th>cover</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($products as $product)
                            <tr >
                                <td>{{$product['id']}}</td>
                                <td>{{$product['title']}}</td>
                                <td>{{$product['description']}}</td>
                                <td id="manage">
                                    <a class='delete' href="" data-id="{{$product['id']}}"><i class="fa fa-remove"></i></a>
                                    <a href="{{route('products.edit',$product['id'])}}" ><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>

                        @empty
                            <div class="alert alert-warning">No products added yet </div>
                        @endforelse


                        </tbody>
                    </table>
@else
                    <div class="alert alert-warning">No products added yet </div>

                @endif
            </div>

        </div>

    </div>
@endsection

@section('js')
    <script>
        $(function () {


            $('.delete').on('click',function (event) {
                event.preventDefault();
                let id= $(this).attr('data-id');

                let state = true;
                let parent = $(this).parent().parent();




                if(confirm('Are you sure for delete this category?')){
                    if(state == true){
                        state = false;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            'url':`http://localhost:8000/admin/products/${id}`,
                            'type':'delete',
                            'dataType':'json',
                            'contentType':false,
                            'cacheProcess':false,
                            'success':function (data) {
                                parent.remove();
                                state= true;
                            },
                            'error':function (data) {



                            }
                        });
                    }

                }



            })


        });




    </script>


@endsection