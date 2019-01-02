@extends('dashboard.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit category</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <form  action="{{route('categories.update',$category['id'])}}"  method="post">
                {{method_field('PUT')}}
                @csrf
                <label class="label label-success">Category name</label>
                <div class="form-group">
                    <input type="text" name="category_name" class="form-control input-lg" placeholder="Edit category name" value="{{$category['name']}}">
                </div>

                <input type="submit" class="btn btn-success btn-block" value="Edit">

            </form>

        </div>

    </div>
@endsection