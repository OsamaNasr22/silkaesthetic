@extends('dashboard.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add new product</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-sm-8">
                <form  action="{{route('products.update',$product['id']) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <label class="label label-success">title</label>
                    <div class="form-group">
                        <input class="form-control" type="text" name="product_title" placeholder="Enter product title" value="{{$product['title']}}">
                    </div>
                    <label class="label label-success">product cover</label>
                    <div class="form-group">
                        <input class="form-control" type="file" name="cover" >
                    </div>
                    <label class="label label-success">product images</label>
                    <div class="form-group">
                        <input class="form-control" type="file" name="image[]" multiple>
                    </div>
                    <label class="label label-success">extra images</label>
                    <div class="form-group">
                        <input class="form-control" type="file" name="extraImages[]" multiple>
                    </div>
                    <label class="label label-success">category</label>
                    <div class="form-group">


                        <select class="form-control" name="category_id">
                            @forelse($categories as $category)
                                <option value="{{$category['id']}}" {{($product['category_id']=== $category['id'])? "selected" :""}} >{{$category['name']}}</option>
                            @empty
                                <option>no category added yet</option>

                            @endforelse
                            <option value=""></option>
                        </select>
                    </div>
                    <label class="label label-primary">Slug</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="product_slug" placeholder="Write slug" value="{{$product['slug']}}">
                    </div>
                    <label class="label label-primary">description</label>
                    <div class="form-group">
                        <textarea id="messageArea" name="product_description" rows="7" class="form-control ckeditor" placeholder="Write your message..">
                            {{html_entity_decode($product['description'])}}
                        </textarea>
                        {{--<textarea class="form-control" name="product_description" placeholder="Enter product description"></textarea>--}}
                    </div>
                    <input type="submit" class="btn btn-success btn-block" value="Add">

                </form>
            </div>


            <h1>Cover</h1>
            <div class="col-sm-4">
                <div class="col-sm-12">
                    <img class="img-responsive" src="{{$product['cover']}} ">
                </div>
      @if($images)
                    <div class="col-md-12">
                        <h1>images</h1>
                        @forelse($images as $image)
                            <div class="col-sm-4">
                                <a href="#" class="delete" data-id="{{$image['id']}}"><i class="fa fa-remove " ></i></a>
                                <img class="img-responsive" src="{{$image['image_url']}}">
                            </div>

                        @empty
                        @endforelse
                    </div>

                @endif

                    @if($product['extra_images'])
                    <div class="col-md-12">
                        <h1>ExtraImages</h1>
                        @forelse($product['extra_images'] as $image)
                            <div class="col-sm-4">
                                <a href="#" class="removeExtra" data-id="{{$product['id']}}" data-url="{{$image}}"><i class="fa fa-remove" ></i></a>
                                <img class="img-responsive" src="{{asset($image)}}">
                            </div>

                        @empty

                        @endforelse
                </div>

                @endif




            </div>

        </div>

    </div>
@endsection

@section('js')


    <script>
        $(function () {
            $('.delete').on('click',function (e) {
              e.preventDefault();
              let id=$(this).attr('data-id') ,
                parent= $(this).parent(),
                  state= true
                ;
            console.log(id);
              if(confirm('This image will be deleted , Are you sure ?')){
                  if(state){
                      state = false;
                      $.ajax({
                          'url':`http://localhost:8000/admin/products/img/${id}` ,
                          'type':'get',
                          'dataType':'json',
                          'contentType':false,
                          'cacheProcess':false,
                          'success':function (data) {
                              state= true;
                              parent.remove();
                          },
                          'error':function (error) {
                            state= true;
                          }
                      });
                  }
              }





            })

            $('.removeExtra').on('click',function (e) {
                e.preventDefault();
                let url=$(this).attr('data-url') ,
                    parent= $(this).parent(),
                    id=$(this).attr('data-id');
                    state= true
                ;
                url = url.split('/').pop();

                if(confirm('This image will be deleted , Are you sure ?')){
                    if(state){
                        state = false;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            'url':`http://localhost:8000/admin/api/product/deleteExtraImage/${id}/${url}` ,
                            'type':'delete',
                            'dataType':'json',
                            'contentType':false,
                            'cacheProcess':false,
                            'success':function (data) {
                                console.log(data);
                                state= true;
                                parent.remove();
                            },
                            'error':function (error) {
                                state= true;
                            }
                        });
                    }
                }





            })


        });

    </script>
    @endsection