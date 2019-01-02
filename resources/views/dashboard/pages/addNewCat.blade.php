@extends('dashboard.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add new category</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <form  action="{{route('categories.store')}}" method="post">
                @csrf

                <label class="label label-primary">Category name</label>
                <div class="form-group">
                    <input type="text" name="category_name" class="form-control input-lg" placeholder="Enter category name">
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="Add">

            </form>

        </div>

    </div>
@endsection