@extends('dashboard.layouts.master')
@section('title') Settings @endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Site settings</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <form  action="{{route('settings.update',$settings->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                {{method_field('PUT')}}
              <label class="label label-primary" for="name">site name</label>
                <div class="form-group">
                    <input class="form-control" id="name" type="text" name="site_name" value="{{$settings->name}}" placeholder="Enter site name">
                </div>
                <label class="label label-primary" for="logo">logo</label>
                <div class="form-group">
                    <input class="form-control" id="logo" name="logo" type="file">
                </div>
                <label class='label label-primary' for="email">email</label>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" value="{{$settings->email}}" placeholder="Enter site email" id="email">
                </div>
                <label class="label label-primary">facebook page</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="facebook" value="{{$settings->facebook}}" placeholder="enter facebook page link">
                </div>
                <label class="label label-primary">twitter page</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="twitter" value="{{$settings->twitter}}" placeholder="enter twitter page link">
                </div>
                <label class="label label-primary">instagram page</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="insta" value="{{$settings->insta}}" placeholder="enter instagram page link">
                </div>
                <label class="label label-primary">linkedin page</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="linkedin" value="{{$settings->linkedin}}" placeholder="enter instagram page link">
                </div>

                <label class="label label-primary">About us</label>
                <div class="form-group">
                    <textarea class="form-control" name="about_us" rows="4">{{$settings->about_us}}</textarea>
                </div>

                <div id="optionContainer">
                    @forelse($settings->extra_options as $key=>$value)
                        <div class="form-group">
                            <label class="label label-primary">in about section</label>
                            <input class="form-control" type="text" name="titles[]" value="{{$key}}" placeholder="enter title">
                            <br>
                            <textarea  name="desc[]" rows="4" class="form-control" placeholder="Write your message..">{{$value}}</textarea>
                        </div>
                    @empty
                    @endforelse
                    <a class="pull-right" href="#" id="addOption">add option</a>
                </div>




                {{--<label class="label label-primary">description</label>--}}
                {{--<div class="form-group">--}}
                    {{--<textarea id="messageArea" name="product_description" rows="7" class="form-control ckeditor" placeholder="Write your message.."></textarea>--}}
                    {{--<textarea class="form-control" name="product_description" placeholder="Enter product description"></textarea>--}}
                {{--</div>--}}
                <a href="#" class="btn btn-primary btn-block" style="display: inline-block;" id="submit">Save Changes</a>

            </form>
        </div>

    </div>
    @endsection
@section('js')
<script>
    $(function () {


        $('#optionContainer').on('click','#addOption',function (e) {
                e.preventDefault();
            var parent= $('#optionContainer');
            var childern= parent.children('.form-group');

                if (childern.length <= 1 ) {
                    var div = $('<div/>', {'class': 'form-group'});
                    div.append(
                        $('<label/>', {'class': 'label label-primary', "text": 'in about section'}),
                        $('<input/>', {
                            'class': 'form-control',
                            "type": 'text',
                            'placeholder': 'enter title',
                            'name': 'titles[]'
                        }),
                        $('<br/>'),
                        $('<textarea/>', {
                            'class': 'form-control',
                            'name': 'desc[]',
                            'rows': '4',
                            'placeholder': 'enter description'
                        }),
                    );
                    $(this).before(div);
                }


            });

    });
</script>
    @endsection
