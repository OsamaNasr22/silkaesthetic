@extends('dashboard.layouts.master')
@section('title') Categories @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Categories</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="table-responsive">
                @if($categories)
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Category Name</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($categories as $category)
                            <tr >
                                <td>{{$category['id']}}</td>
                                <td>{{$category['name']}}</td>
                                <td id="manage">
                                    <form method="post" action="{{route('categories.destroy',$category['id'])}}" style="display: inline">
                                        {{method_field('delete')}}
                                        @csrf
                                        <a class='delete btn btn-danger' href="" ><i class="fa fa-remove"></i> Delete</a>
                                    </form>
                                    <a class="btn btn-success" href="{{route('categories.edit',$category['id'])}}" ><i class="fa fa-edit"></i> Edit</a>
                                </td>
                            </tr>

                        @empty
                            <div class="alert alert-warning">No categories added yet </div>
                        @endforelse


                        </tbody>
                    </table>

                @else
                    <div class="alert alert-warning">No categories added yet <a href="{{route('categories.create')}}">Add Now</a></div>
                @endif
            </div>

        </div>

    </div>
@endsection
