@extends('dashboard.layouts.master')
@section('title') Add new category @endsection

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
            <form  action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
                {{--@csrf--}}
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <label class="label label-primary">Category name</label>
                <div class="form-group">
                    <input type="text" name="category_name" class="form-control" placeholder="Enter category name">
                </div>
                <label class="label label-primary">Cover</label>
                <div class="form-group">
                    <input type="file" name="cover" class="form-control" >
                </div>

                <div id="containerOptions">
                  {{--<div class="form-group">--}}
                      {{--<label class="label label-primary">option</label>--}}
                      {{--<span title="Remove option" class="removeOption pull-right"><i class="fa fa-remove"></i></span>--}}
                      {{--<input type="text" class="form-control" name="titles[]" placeholder="Enter the option name">--}}
                      {{--<input type="file" name="optionImages[]" class="form-control">--}}

                      {{--<textarea id="messageArea" name="desc[]" rows="7" class="form-control ckeditor" placeholder="Write the description of this option"></textarea>--}}
                  {{--</div>--}}
                    <a href="#" id="addNewOption" class="pull-right" style="margin-bottom: 2px"><i class="fa fa-plus"></i> add new option</a>

                </div>

                <a href="#" class="btn btn-primary btn-block" style="display: inline-block;" id="submit">Add</a>

            </form>

        </div>

    </div>
@endsection

@section('js')
    <script>
        var count = 0;
        $(function () {
            $('#containerOptions').on('click','#addNewOption',function (e) {
                e.preventDefault();
                var element =$(this);
                var divElement = $('<div/>',{"class":"form-group"});
                divElement.append(
                    $('<label/>',{'class':'label label-primary','text':'option'}),
                     $('<span/>', {'title':'Remove option', 'class':'removeOption pull-right'}).append($('<i/>',{'class':'fa fa-remove'})),
                     $('<input/>',{'type':'text','class':'form-control','name':'titles[]','placeholder':'Enter the option name'}),
                    $('<input/>',{'type':'file','class':'form-control','name':'optionImages['+count+']'}),
                     $('<textarea/>',
                         {'id':'messageArea'+count,'name':'desc[]','rows':'7','class':'form-control ckeditor ','placeholder':'Write the description of this option'}),

                 );
                element.before(divElement);

                //CKEDITOR.replace('messageArea1')
                 for (name in CKEDITOR.instances){
                     if (name === 'messageArea'+count) CKEDITOR.instances[name].destroy();
                 }
                 CKEDITOR.replace('messageArea'+count);
                 count ++;
            });

            $('#containerOptions').on('click','.removeOption',function (e) {
               var el= $(this);
               var id = el.siblings('textarea').attr('id');
               console.log(id);
                var parent = el.parent();
                if (confirm('Are you sure delete this option')){
                    parent.remove();
                    CKEDITOR.instances[id].destroy();
                    if (count > 0) count --;

                }
            })

        });
    </script>
    @endsection