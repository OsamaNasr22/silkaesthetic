@extends('dashboard.layouts.master')
@section('title') Add Banner @endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add new banner</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <form  action="{{route('sliders.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <label class="label label-primary">Banner</label>
                <div class="form-group">
                    <input class="form-control" type="file" name="image" >
                </div>
                <label class="label label-primary">type</label>
              <div class="form-group">
                  <select name="type" class="form-control">
                      <option value="slider" title="add to slider">slider</option>
                      <option value="extra">extra images</option>
                  </select>
              </div>
                <a href="#" class="btn btn-primary btn-block" id="submit">Add</a>

            </form>
        </div>

    </div>

@endsection

@section('js')


@endsection