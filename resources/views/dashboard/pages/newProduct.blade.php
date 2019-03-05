@extends('dashboard.layouts.master')

@section('js')


@endsection
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
            <form  action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <label class="label label-primary">title</label>
                <div class="form-group">
                    <input class="form-control" type="text" name="product_title" placeholder="Enter product title">
                </div>
                <label class="label label-primary">product cover</label>
                <div class="form-group">
                    <input class="form-control" type="file" name="cover" >
                </div>
                <label class="label label-primary">product images</label>
                <div class="form-group">
                    <input class="form-control" type="file" name="image[]" multiple>
                </div>
                <label class="label label-primary">extra images</label>
                <div class="form-group">
                    <input class="form-control" type="file" name="extraImages[]" multiple>
                </div>
                <label class="label label-primary">category</label>
                <div class="form-group">
                    <select class="form-control" name="category_id">
                        @forelse($categories as $category)
                            <option value="{{$category['id']}}">{{$category['name']}}</option>
                        @empty
                            <   option>no category added yet</option>

                            @endforelse
                        <option value=""></option>
                    </select>
                </div>
                <label class="label label-primary">Slug</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="product_slug" placeholder="Write slug">
                </div>
                <label class="label label-primary">description</label>
                <div class="form-group">
                    <textarea id="messageArea" name="product_description" rows="7" class="form-control ckeditor" placeholder="Write your message.."></textarea>
                    {{--<textarea class="form-control" name="product_description" placeholder="Enter product description"></textarea>--}}
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="Add">

            </form>
        </div>

    </div>
@endsection