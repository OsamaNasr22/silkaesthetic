@extends('dashboard.layouts.master')
@section('title') Edit product @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit product</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-sm-8">
                <form  action="{{route('products.update',$product['id']) }}" method="post" enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    {{--@csrf--}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
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
                    <label class="label label-success">Slug</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="product_slug" placeholder="Write slug" value="{{$product['slug']}}">
                    </div>
                    <label class="label label-success">description</label>
                    <div class="form-group">
                        <textarea id="messageArea" name="product_description" rows="7" class="form-control ckeditor" placeholder="Write your message..">
                            {!! html_entity_decode($product['description']) !!}
                        </textarea>
                        {{--<textarea class="form-control" name="product_description" placeholder="Enter product description"></textarea>--}}
                    </div>
                    <input type="hidden" name="deleteImages" id="deleteImages" value="">
                    <input type="hidden" name="deleteExtraImages" id="deleteExtraImages" value="">
                    <a href="#" class="btn btn-success btn-block" id="submit">Edit</a>

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
                                <a href="#" class="deleteImage" data-id="{{$image['id']}}"><i class="fa fa-remove " ></i></a>
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
            $('.deleteImage').on('click',function (e) {
                e.preventDefault();
                var el= $(this);
                var heading= el.parent().siblings('h1');
                var inputDelete= $('#deleteImages');
                var parent= el.parent();
                var id= el.attr('data-id');
                var value= inputDelete.val().split(',');

                if (confirm('This image will be deleted, Are you sure??')){
                    value.push(id);
                    value = value.filter(function (e) {
                        return e.length >0;
                    })
                    inputDelete.val(value.join(','));
                    parent.remove();
                    if ($('.deleteImage').length == 0) {
                    heading.remove();
                    }
                }

            })


            $('.removeExtra').on('click',function (e) {

                e.preventDefault();
                var el= $(this);
                var heading= el.parent().siblings('h1');
                var inputDelete= $('#deleteExtraImages');
                var parent= el.parent();
                var url= el.attr('data-url').split('/').pop();
                var value= inputDelete.val().split(',');
                if (confirm('This image will be deleted, Are you sure??')){
                    value.push(url);
                    value = value.filter(function (e) {
                        return e.length >0;
                    })
                    inputDelete.val(value.join(','));
                    parent.remove();
                    if ($('.removeExtra').length == 0) {
                        heading.remove();
                    }

                }
            })

        });

    </script>
    @endsection